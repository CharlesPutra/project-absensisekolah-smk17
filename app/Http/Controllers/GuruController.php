<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jadwalguru;
use App\Models\Jadwalkaryawan;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //paginate dan search 
        $search = $request->input('search');

        $gurus = Guru::with('jurusan', 'jadwalgr', 'jadwalkr')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('no_guru', 'like', "%{$search}%")
                        ->orWhere('nama_guru', 'like', "%{$search}%")
                        ->orWhere('jenis_kelamin', 'like', "%{$search}%")
                        ->orWhere('karyawan', 'like', "%{$search}%")
                        // ->orWhere('hari', 'like', "%{$search}%")
                        // ->orWhere('pulang', 'like', "%{$search}%")
                        ->orWhereHas('jurusan', function ($q2) use ($search) {
                            $q2->where('no_jurusan', 'like', "%{$search}%");
                        })
                        ->orWhereHas('jadwalkr', function ($q2) use ($search) {
                            $q2->where('no_jadwal', 'like', "%{$search}%");
                        })
                        ->orWhereHas('jadwalgr', function ($q2) use ($search) {
                            $q2->where('no_jadwalguru', 'like', "%{$search}%");
                        });
                });
            })->paginate(5);
        return view('guru.index', compact('gurus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $jurusans = Jurusan::all();
        $jadwalguru = Jadwalguru::all();
        $jadwalkr = Jadwalkaryawan::all();
        $lastGuru = Guru::count(); // Jika tabel guru sudah ada dan kolom no_guru ada

        // Tentukan no_guru yang akan ditampilkan di form
        $nextNoGuru = $lastGuru ? $lastGuru + 1 : 1;

        // dd($jadwalkr);
        return view('guru.create', compact('jurusans', 'jadwalguru', 'jadwalkr', 'nextNoGuru'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Log data request
        // Log::info('Data Request:', ['data' => $request->all()]);
        // Log::info('Karyawan:', ['karyawan' => $request->karyawan]);

        $rules = [
            'no_guru' => 'required|integer',
            'nama_guru' => 'required|string',
            'jenis_kelamin' => 'required',
            'karyawan' => 'required',
            'id_jadwalkaryawan' => 'required|exists:jadwalkaryawans,id',
            'id_jurusan' => 'required|exists:jurusans,id',
            'id_jadwalguru' => 'required|exists:jadwalgurus,id'
        ];

        if ($request->karyawan == 'Karyawan') {
            $rules['id_jadwalkaryawan'] = 'required|exists:jadwalkaryawans,id';
            // saat role Karyawan, id_jurusan dan id_jadwalguru boleh null
            $rules['id_jurusan'] = 'nullable|exists:jurusans,id'; // membuat id_jurusan nullable
            $rules['id_jadwalguru'] = 'nullable|exists:jadwalgurus,id'; // membuat id_jadwalguru nullable
            $request->merge([
                'id_jurusan' => null,
                'id_jadwalguru' => null,
            ]);
        } elseif ($request->karyawan == 'Guru') {
            $rules['id_jurusan'] = 'required|exists:jurusans,id';
            $rules['id_jadwalguru'] = 'required|exists:jadwalgurus,id';
            // saat role Guru, jadwalkaryawan boleh null
            $request->merge([
                'id_jadwalkaryawan' => null,
            ]);
        }


        // Log::info('Rules:', ['rules' => $rules]);

        // Validasi data
        // try {
        //     $validatedData = $request->validate($rules);
        //     Log::info('Validated Data:', ['validated_data' => $validatedData]);
        // } catch (\Illuminate\Validation\ValidationException $e) {
        //     Log::error('Validation Failed:', ['errors' => $e->errors()]);
        //     return redirect()->back()->withErrors($e->errors())->withInput();
        // }

        // Cek apakah validasi berhasil dan lanjutkan
        // dd('Data validasi berhasil', $request);
        Guru::create($request->all());
        return redirect()->route('guru.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
          $jurusans = Jurusan::all();
        $jadwalguru = Jadwalguru::all();
        $jadwalkr = Jadwalkaryawan::all();
        $show = Guru::findOrFail($id);
        return view('guru.show',compact('jurusans','jadwalguru','jadwalkr','show'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jurusans = Jurusan::all();
        $jadwalguru = Jadwalguru::all();
        $jadwalkr = Jadwalkaryawan::all();
        $guruedit = Guru::findOrFail($id);
        return view('guru.edit',compact('jurusans','jadwalguru','jadwalkr','guruedit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $update = Guru::findOrFail($id);
         $rules = [
            'no_guru' => 'required|integer',
            'nama_guru' => 'required|string',
            'jenis_kelamin' => 'required',
            'karyawan' => 'required',
            'id_jadwalkaryawan' => 'required|exists:jadwalkaryawans,id',
            'id_jurusan' => 'required|exists:jurusans,id',
            'id_jadwalguru' => 'required|exists:jadwalgurus,id'
        ];

        if ($request->karyawan == 'Karyawan') {
            $rules['id_jadwalkaryawan'] = 'required|exists:jadwalkaryawans,id';
            // saat role Karyawan, id_jurusan dan id_jadwalguru boleh null
            $rules['id_jurusan'] = 'nullable|exists:jurusans,id'; // membuat id_jurusan nullable
            $rules['id_jadwalguru'] = 'nullable|exists:jadwalgurus,id'; // membuat id_jadwalguru nullable
            $request->merge([
                'id_jurusan' => null,
                'id_jadwalguru' => null,
            ]);
        } elseif ($request->karyawan == 'Guru') {
            $rules['id_jurusan'] = 'required|exists:jurusans,id';
            $rules['id_jadwalguru'] = 'required|exists:jadwalgurus,id';
            // saat role Guru, jadwalkaryawan boleh null
            $request->merge([
                'id_jadwalkaryawan' => null,
            ]);
        }
        $update->update($request->all());
        return redirect()->route('guru.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guruhapus = Guru::findOrFail($id);
        $guruhapus->delete();
        return redirect()->route('guru.index');
    }
}
