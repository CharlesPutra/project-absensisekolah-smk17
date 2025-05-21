<?php

namespace App\Http\Controllers;

use App\Models\Jadwalkaryawan;
use Illuminate\Http\Request;

class JadwalkaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil query pencarian dari request
        $search = $request->input('search');
        // Query untuk mengambil data jurusan dengan pencarian
        $karyawans = Jadwalkaryawan::when($search, function ($query, $search) {
            return $query->where('no_jadwal', 'like', "%{$search}%")
                ->orWhere('hari', 'like', "%{$search}%")
                ->orWhere('pulang', 'like', "%{$search}%")
                ->orWhere('keterlambatan', 'like', "%{$search}%")
                ->orWhere('keterangan', 'like', "%{$search}%")
                ->orWhere('masuk', 'like', "%{$search}%");
        })->paginate(5); // Menggunakan pagination

        return view('jadwal karyawan.index', compact('karyawans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jadwal karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_jadwal' => 'required',
            'masuk' => 'required',
            'pulang' => 'required',
            'keterlambatan' => 'required',
            'keterangan' => 'required',
            'hari' => 'required',
        ]);
        Jadwalkaryawan::create($request->all());
        return redirect()->route('jadwalkaryawan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $show = Jadwalkaryawan::findOrFail($id);
        return view('jadwal karyawan.show',compact('show'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $karyawanedit = Jadwalkaryawan::findOrfail($id);
        return view('jadwal karyawan.edit', compact('karyawanedit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $karyawanupdate = Jadwalkaryawan::findOrFail($id);
        $request->validate([
            'no_jadwal' => 'required',
            'masuk' => 'required',
            'pulang' => 'required',
            'keterlambatan' => 'required',
            'keterangan' => 'required',
            'hari' => 'required',
        ]);
        $karyawanupdate->update($request->all());
        return redirect()->route('jadwalkaryawan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $karyawanhapus = Jadwalkaryawan::findOrFail($id);
        $karyawanhapus->delete();
        return redirect()->route('jadwalkaryawan.index');
    }
}
