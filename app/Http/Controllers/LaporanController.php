<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class LaporanController extends Controller
{
    public function Showlapor()
    {
        return view('laporan.laporan');
    }
    //     public function filter(Request $request)
    //     {
    //         $absensi = Laporan::with('guru')->get();
    // dd($absensi);

    //         $query = Laporan::query()->with('guru');

    //         $tahun = $request->input('tahun');
    //         $bulan = $request->input('bulan');
    //         $karyawan = $request->input('karyawan');

    //         if ($tahun && $bulan) {
    //             $bulanFormatted = str_pad($bulan, 2, '0', STR_PAD_LEFT);
    //             $query->where('waktu_absen', 'like', "$tahun-$bulanFormatted%");
    //         } elseif ($tahun) {
    //             $query->where('waktu_absen', 'like', "$tahun%");
    //         }

    //         if ($karyawan) {
    //             $query->whereHas('guru', function ($q) use ($karyawan) {
    //                 $q->where('karyawan', $karyawan);
    //             });
    //         }

    //         $absensi = $query->get();

    //         return view('laporan.result', compact('absensi'));
    //     }
    public function filter(Request $request)
    {
        // Ambil input filter dari request
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $karyawan = $request->input('karyawan');

        $bulanFormatted = $bulan ? str_pad($bulan, 2, '0', STR_PAD_LEFT) : null;
        $jamBatasTelat = '06:30:00';

        // Hitung total hari dalam bulan yang difilter
        $totalHariDalamBulan = 0;
        if ($tahun && $bulan) {
            $totalHariDalamBulan = Carbon::createFromDate($tahun, $bulan, 1)->daysInMonth;
        }

        // STEP 1: Ambil absen pertama per hari per user
        $subQuery = DB::table('laporans')
            ->select(
                'id_anggota',
                DB::raw('DATE(waktu_absen) as tanggal'),
                DB::raw('MIN(TIME(waktu_absen)) as jam_masuk')
            )
            ->groupBy('id_anggota', DB::raw('DATE(waktu_absen)'));

        // Filter tahun/bulan
        if ($tahun && $bulanFormatted) {
            $subQuery->whereRaw("LEFT(waktu_absen, 7) = ?", ["$tahun-$bulanFormatted"]);
        } elseif ($tahun) {
            $subQuery->whereRaw("LEFT(waktu_absen, 4) = ?", [$tahun]);
        }

        // Subquery jadi table: absensi_per_hari
        $absensiPerHari = DB::table(DB::raw("({$subQuery->toSql()}) as absensi_per_hari"))
            ->mergeBindings($subQuery)
            ->get();

        // STEP 2: Rekap kehadiran dan telat
        $rekapPerGuru = [];
        foreach ($absensiPerHari as $absen) {
            $id = $absen->id_anggota;
            $rekapPerGuru[$id]['total_absen'] = ($rekapPerGuru[$id]['total_absen'] ?? 0) + 1;
            if ($absen->jam_masuk > $jamBatasTelat) {
                $rekapPerGuru[$id]['total_telat'] = ($rekapPerGuru[$id]['total_telat'] ?? 0) + 1;
            }
        }

        // STEP 3: Ambil data guru
        $guruQuery = DB::table('gurus');
        if ($karyawan) {
            $guruQuery->where('karyawan', 'like', "%$karyawan%");
        }
        $guruList = $guruQuery->get()->keyBy('id');

        // STEP 4: Ijin per guru
        $ijinData = DB::table('ijins')->select('id_nama', 'tanggal_mulai', 'tanggal_berakhir')->get();

        $ijinPerGuru = [];
        foreach ($ijinData as $ijin) {
            $start = Carbon::parse($ijin->tanggal_mulai);
            $end = Carbon::parse($ijin->tanggal_berakhir);

            for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
                if ($tahun && $bulan && $date->year == $tahun && $date->month == $bulan) {
                    $ijinPerGuru[$ijin->id_nama] = ($ijinPerGuru[$ijin->id_nama] ?? 0) + 1;
                }
            }
        }

        // STEP 5: Gabungkan semua ke hasil akhir
        $absensi = [];

        foreach ($guruList as $id => $guru) {
            $totalAbsen = $rekapPerGuru[$id]['total_absen'] ?? 0;
            $totalTelat = $rekapPerGuru[$id]['total_telat'] ?? 0;
            $totalIjin = $ijinPerGuru[$id] ?? 0;
            $totalTidakHadir = $totalHariDalamBulan - ($totalAbsen + $totalIjin);

            $absensi[] = (object) [
                'id_anggota' => $id,
                'nama_guru' => $guru->nama_guru,
                'no_guru' => $guru->no_guru,
                'jenis_kelamin' => $guru->jenis_kelamin,
                'total_absen' => $totalAbsen,
                'total_telat' => $totalTelat,
                'total_ijin' => $totalIjin,
                'total_tidak_hadir' => max(0, $totalTidakHadir),
            ];
        }

        return view('laporan.result', [
            'absensi' => collect($absensi),
            'tahun' => $tahun,
            'bulan' => $bulan,
            'karyawan' => $karyawan,
        ]);
    }

    public function detailAbsensi(Request $request, $id)
    {
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $bulanFormatted = str_pad($bulan, 2, '0', STR_PAD_LEFT);

        Carbon::setLocale('id');
        $jumlahHariDalamBulan = Carbon::create($tahun, $bulan, 1)->daysInMonth;

        // Guru
        $guru = \App\Models\Guru::with('jurusan')->find($id);

        // Ambil semua absen dari DB
        $absensi = DB::table('laporans')
            ->where('id_anggota', $id)
            ->whereRaw('LEFT(waktu_absen, 7) = ?', ["$tahun-$bulanFormatted"])
            ->orderBy('waktu_absen')
            ->get();

        // Kelompokkan semua absen per tanggal
        $absensiPerTanggal = [];
        foreach ($absensi as $a) {
            $tanggal = Carbon::parse($a->waktu_absen)->format('Y-m-d');
            $jam = Carbon::parse($a->waktu_absen)->format('H:i:s');
            $absensiPerTanggal[$tanggal][] = $jam;
        }

        // Izin
        $ijinTanggal = [];
        $ijinData = DB::table('ijins')
            ->where('id_nama', $id)
            ->where(function ($q) use ($tahun, $bulan) {
                $q->whereYear('tanggal_mulai', $tahun)->whereMonth('tanggal_mulai', $bulan)
                    ->orWhereYear('tanggal_berakhir', $tahun)->whereMonth('tanggal_berakhir', $bulan);
            })
            ->get();

        foreach ($ijinData as $ijin) {
            $start = Carbon::parse($ijin->tanggal_mulai);
            $end = Carbon::parse($ijin->tanggal_berakhir);

            for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
                if ($date->year == $tahun && $date->month == $bulan) {
                    $ijinTanggal[] = $date->format('Y-m-d');
                }
            }
        }

        // Proses absensi harian
        $absensiPerHari = [];

        for ($i = 1; $i <= $jumlahHariDalamBulan; $i++) {
            $date = Carbon::create($tahun, $bulan, $i);
            $formattedDate = $date->format('Y-m-d');
            $hari = $date->translatedFormat('l');

            $status = 'Tidak Hadir';
            $jamMasuk = null;
            $jamPulang = null;

            if ($hari === 'Minggu') {
                $status = 'Libur';
            } elseif (in_array($formattedDate, $ijinTanggal)) {
                $status = 'Ijin/Cuti/Sakit';
            } elseif (isset($absensiPerTanggal[$formattedDate])) {
                // Ambil semua absen pada tanggal ini
                $jamList = $absensiPerTanggal[$formattedDate];
                sort($jamList); // urutkan dari paling pagi

                $jamMasuk = $jamList[0]; // jam masuk = pertama

                // Cari absen yang >= 12:30:00 sebagai jam pulang
                foreach (array_reverse($jamList) as $jam) {
                    if ($jam >= '13:00:00') {
                        $jamPulang = $jam;
                        break;
                    }
                }

                // Status berdasarkan jam masuk
                if ($jamMasuk > '06:30:00') {
                    $status = 'Telat';
                } else {
                    $status = 'Hadir';
                }
            }

            $absensiPerHari[$i] = [
                'tanggal' => $formattedDate,
                'hari' => $hari,
                'status' => $status,
                'jam_masuk' => $jamMasuk,
                'jam_pulang' => $jamPulang,
            ];
        }

        return view('laporan.absensi_detail', compact(
            'guru',
            'tahun',
            'bulan',
            'absensiPerHari',
            'jumlahHariDalamBulan'
        ));
    }

    public function exportAbsensiPDF(Request $request, $id)
    {
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $bulanFormatted = str_pad($bulan, 2, '0', STR_PAD_LEFT);

        Carbon::setLocale('id');
        $jumlahHariDalamBulan = Carbon::create($tahun, $bulan, 1)->daysInMonth;

        $guru = \App\Models\Guru::with('jurusan')->find($id);

        // Ambil semua absen untuk ID ini di bulan & tahun tertentu
        $absensi = DB::table('laporans')
            ->where('id_anggota', $id)
            ->whereRaw('LEFT(waktu_absen, 7) = ?', ["$tahun-$bulanFormatted"])
            ->orderBy('waktu_absen')
            ->get();

        // Kelompokkan semua absen per tanggal
        $absensiPerTanggal = [];
        foreach ($absensi as $a) {
            $tanggal = Carbon::parse($a->waktu_absen)->format('Y-m-d');
            $jam = Carbon::parse($a->waktu_absen)->format('H:i:s');
            $absensiPerTanggal[$tanggal][] = $jam;
        }

        // Ambil data ijin
        $ijinTanggal = [];
        $ijinData = DB::table('ijins')
            ->where('id_nama', $id)
            ->where(function ($q) use ($tahun, $bulan) {
                $q->whereYear('tanggal_mulai', $tahun)->whereMonth('tanggal_mulai', $bulan)
                    ->orWhereYear('tanggal_berakhir', $tahun)->whereMonth('tanggal_berakhir', $bulan);
            })
            ->get();

        foreach ($ijinData as $ijin) {
            $start = Carbon::parse($ijin->tanggal_mulai);
            $end = Carbon::parse($ijin->tanggal_berakhir);

            for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
                if ($date->year == $tahun && $date->month == $bulan) {
                    $ijinTanggal[] = $date->format('Y-m-d');
                }
            }
        }

        // Buat data absensi per hari
        $absensiPerHari = [];

        for ($i = 1; $i <= $jumlahHariDalamBulan; $i++) {
            $date = Carbon::create($tahun, $bulan, $i);
            $formattedDate = $date->format('Y-m-d');
            $hari = $date->translatedFormat('l');

            $status = 'Tidak Hadir';
            $jamMasuk = null;
            $jamPulang = null;

            if ($hari === 'Minggu') {
                $status = 'Libur';
            } elseif (in_array($formattedDate, $ijinTanggal)) {
                $status = 'Ijin/Cuti/Sakit';
            } elseif (array_key_exists($formattedDate, $absensiPerTanggal)) {
                $jamList = $absensiPerTanggal[$formattedDate];
                sort($jamList);

                $jamMasuk = $jamList[0];

                foreach (array_reverse($jamList) as $jam) {
                    if ($jam >= '13:00:00') {
                        $jamPulang = $jam;
                        break;
                    }
                }

                if ($jamMasuk > '06:30:00') {
                    $status = 'Telat';
                } else {
                    $status = 'Hadir';
                }
            }

            $absensiPerHari[$i] = [
                'tanggal' => $formattedDate,
                'hari' => $hari,
                'status' => $status,
                'jam_masuk' => $jamMasuk,
                'jam_pulang' => $jamPulang,
            ];
        }

        // Buat PDF
        $pdf = PDF::loadView('laporan.absensi_pdf', compact(
            'guru',
            'tahun',
            'bulan',
            'absensiPerHari',
            'jumlahHariDalamBulan'
        ));

        $namaFile = 'Absensi_' . $guru->nama_guru . "_$bulan-$tahun.pdf";

        return $pdf->download($namaFile);
    }


    public function printAbsensi(Request $request, $id)
    {
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $bulanFormatted = str_pad($bulan, 2, '0', STR_PAD_LEFT);

        Carbon::setLocale('id');
        $jumlahHariDalamBulan = Carbon::create($tahun, $bulan, 1)->daysInMonth;

        $guru = \App\Models\Guru::with('jurusan')->find($id);

        $absensi = DB::table('laporans')
            ->where('id_anggota', $id)
            ->whereRaw('LEFT(waktu_absen, 7) = ?', ["$tahun-$bulanFormatted"])
            ->orderBy('waktu_absen')
            ->get();

        // Group absen by date
        $groupedAbsensi = [];
        foreach ($absensi as $a) {
            $tanggal = Carbon::parse($a->waktu_absen)->format('Y-m-d');
            $jam = Carbon::parse($a->waktu_absen)->format('H:i:s');
            $groupedAbsensi[$tanggal][] = $jam;
        }

        // Ijin
        $ijinTanggal = [];
        $ijinData = DB::table('ijins')
            ->where('id_nama', $id)
            ->where(function ($q) use ($tahun, $bulan) {
                $q->whereYear('tanggal_mulai', $tahun)->whereMonth('tanggal_mulai', $bulan)
                    ->orWhereYear('tanggal_berakhir', $tahun)->whereMonth('tanggal_berakhir', $bulan);
            })
            ->get();

        foreach ($ijinData as $ijin) {
            $start = Carbon::parse($ijin->tanggal_mulai);
            $end = Carbon::parse($ijin->tanggal_berakhir);
            for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
                if ($date->year == $tahun && $date->month == $bulan) {
                    $ijinTanggal[] = $date->format('Y-m-d');
                }
            }
        }

        // Per tanggal
        $absensiPerHari = [];
        for ($i = 1; $i <= $jumlahHariDalamBulan; $i++) {
            $date = Carbon::create($tahun, $bulan, $i);
            $formattedDate = $date->format('Y-m-d');
            $hari = $date->translatedFormat('l');

            $status = 'Tidak Hadir';
            $jamMasuk = null;
            $jamPulang = null;

            if ($hari === 'Minggu') {
                $status = 'Libur';
            } elseif (in_array($formattedDate, $ijinTanggal)) {
                $status = 'Ijin/Cuti/Sakit';
            } elseif (isset($groupedAbsensi[$formattedDate])) {
                $jamMasuk = min($groupedAbsensi[$formattedDate]);
                $jamPulang = max($groupedAbsensi[$formattedDate]);

                if ($jamMasuk > '06:30:00') {
                    $status = 'Telat';
                } else {
                    $status = 'Hadir';
                }

                // Optional: filter atau tandai jika jam pulang terlalu cepat, misalnya sebelum jam 12 siang
                if ($jamPulang < '12:00:00') {
                    $status .= ' (Pulang Cepat)';
                }
            }

            $absensiPerHari[$i] = [
                'tanggal' => $formattedDate,
                'hari' => $hari,
                'status' => $status,
                'jam_masuk' => $jamMasuk,
                'jam_pulang' => $jamPulang,
            ];
        }

        return view('laporan.absensi_print', compact(
            'guru',
            'tahun',
            'bulan',
            'absensiPerHari',
            'jumlahHariDalamBulan'
        ));
    }


    public function exportSemuaGuruPDF(Request $request)
    {
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $bulanFormatted = str_pad($bulan, 2, '0', STR_PAD_LEFT);

        Carbon::setLocale('id');
        $jumlahHariDalamBulan = Carbon::create($tahun, $bulan, 1)->daysInMonth;

        $gurus = \App\Models\Guru::with('jurusan')->get();
        $dataRekap = [];

        foreach ($gurus as $guru) {
            $id = $guru->id;

            $absensi = DB::table('laporans')
                ->where('id_anggota', $id)
                ->whereRaw('LEFT(waktu_absen, 7) = ?', ["$tahun-$bulanFormatted"])
                ->orderBy('waktu_absen')
                ->get();

            // Group absen by date
            $groupedAbsensi = [];
            foreach ($absensi as $a) {
                $tanggal = Carbon::parse($a->waktu_absen)->format('Y-m-d');
                $jam = Carbon::parse($a->waktu_absen)->format('H:i:s');
                $groupedAbsensi[$tanggal][] = $jam;
            }

            // Ijin / cuti / sakit
            $ijinTanggal = [];
            $ijinData = DB::table('ijins')
                ->where('id_nama', $id)
                ->where(function ($q) use ($tahun, $bulan) {
                    $q->whereYear('tanggal_mulai', $tahun)->whereMonth('tanggal_mulai', $bulan)
                        ->orWhereYear('tanggal_berakhir', $tahun)->whereMonth('tanggal_berakhir', $bulan);
                })
                ->get();

            foreach ($ijinData as $ijin) {
                $start = Carbon::parse($ijin->tanggal_mulai);
                $end = Carbon::parse($ijin->tanggal_berakhir);

                for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
                    if ($date->year == $tahun && $date->month == $bulan) {
                        $ijinTanggal[] = $date->format('Y-m-d');
                    }
                }
            }

            // Buat data per hari
            $absensiPerHari = [];
            for ($i = 1; $i <= $jumlahHariDalamBulan; $i++) {
                $date = Carbon::create($tahun, $bulan, $i);
                $formattedDate = $date->format('Y-m-d');
                $hari = $date->translatedFormat('l');

                $status = 'Tidak Hadir';
                $jamMasuk = null;
                $jamPulang = null;

                if ($hari === 'Minggu') {
                    $status = 'Libur';
                } elseif (in_array($formattedDate, $ijinTanggal)) {
                    $status = 'Ijin/Cuti/Sakit';
                } elseif (isset($groupedAbsensi[$formattedDate])) {
                    $jamMasuk = min($groupedAbsensi[$formattedDate]);
                    $jamPulang = max($groupedAbsensi[$formattedDate]);

                    if ($jamMasuk > '06:30:00') {
                        $status = 'Telat';
                    } else {
                        $status = 'Hadir';
                    }

                    if ($jamPulang < '12:00:00') {
                        $status .= ' (Pulang Cepat)';
                    }
                }

                $absensiPerHari[$i] = [
                    'tanggal' => $formattedDate,
                    'hari' => $hari,
                    'status' => $status,
                    'jam_masuk' => $jamMasuk,
                    'jam_pulang' => $jamPulang,
                ];
            }

            $dataRekap[] = [
                'guru' => $guru,
                'absensiPerHari' => $absensiPerHari
            ];
        }

        $pdf = PDF::loadView('laporan.absensi_semua_pdf', compact('dataRekap', 'tahun', 'bulan'))
            ->setPaper('A4', 'portrait');

        return $pdf->download("Laporan_Absensi_Semua_Guru_{$bulan}-{$tahun}.pdf");
    }

    public function printSemuaGuru(Request $request)
    {
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $bulanFormatted = str_pad($bulan, 2, '0', STR_PAD_LEFT);

        Carbon::setLocale('id');
        $jumlahHariDalamBulan = Carbon::create($tahun, $bulan, 1)->daysInMonth;

        $gurus = \App\Models\Guru::with('jurusan')->get();
        $dataRekap = [];

        foreach ($gurus as $guru) {
            $id = $guru->id;

            $absensi = DB::table('laporans')
                ->where('id_anggota', $id)
                ->whereRaw('LEFT(waktu_absen, 7) = ?', ["$tahun-$bulanFormatted"])
                ->orderBy('waktu_absen')
                ->get();

            // Group absen by date
            $groupedAbsensi = [];
            foreach ($absensi as $a) {
                $tanggal = Carbon::parse($a->waktu_absen)->format('Y-m-d');
                $jam = Carbon::parse($a->waktu_absen)->format('H:i:s');
                $groupedAbsensi[$tanggal][] = $jam;
            }

            // Ambil tanggal ijin/cuti
            $ijinTanggal = [];
            $ijinData = DB::table('ijins')
                ->where('id_nama', $id)
                ->where(function ($q) use ($tahun, $bulan) {
                    $q->whereYear('tanggal_mulai', $tahun)->whereMonth('tanggal_mulai', $bulan)
                        ->orWhereYear('tanggal_berakhir', $tahun)->whereMonth('tanggal_berakhir', $bulan);
                })
                ->get();

            foreach ($ijinData as $ijin) {
                $start = Carbon::parse($ijin->tanggal_mulai);
                $end = Carbon::parse($ijin->tanggal_berakhir);
                for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
                    if ($date->year == $tahun && $date->month == $bulan) {
                        $ijinTanggal[] = $date->format('Y-m-d');
                    }
                }
            }

            // Proses rekap harian
            $absensiPerHari = [];
            for ($i = 1; $i <= $jumlahHariDalamBulan; $i++) {
                $date = Carbon::create($tahun, $bulan, $i);
                $formattedDate = $date->format('Y-m-d');
                $hari = $date->translatedFormat('l');

                $status = 'Tidak Hadir';
                $jamMasuk = null;
                $jamPulang = null;

                if ($hari === 'Minggu') {
                    $status = 'Libur';
                } elseif (in_array($formattedDate, $ijinTanggal)) {
                    $status = 'Ijin/Cuti/Sakit';
                } elseif (isset($groupedAbsensi[$formattedDate])) {
                    $jamMasuk = min($groupedAbsensi[$formattedDate]);
                    $jamPulang = max($groupedAbsensi[$formattedDate]);

                    if ($jamMasuk > '06:30:00') {
                        $status = 'Telat';
                    } else {
                        $status = 'Hadir';
                    }

                    // Tandai jika pulang lebih awal
                    if ($jamPulang < '12:00:00') {
                        $status .= ' (Pulang Cepat)';
                    }
                }

                $absensiPerHari[$i] = [
                    'tanggal' => $formattedDate,
                    'hari' => $hari,
                    'status' => $status,
                    'jam_masuk' => $jamMasuk,
                    'jam_pulang' => $jamPulang,
                ];
            }

            $dataRekap[] = [
                'guru' => $guru,
                'absensiPerHari' => $absensiPerHari
            ];
        }

        return view('laporan.absensi_semua_print', compact('dataRekap', 'tahun', 'bulan'));
    }
}
