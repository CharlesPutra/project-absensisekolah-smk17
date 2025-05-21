<?php

namespace App\Http\Controllers;

use App\Models\Jadwalguru;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JadwalguruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        //ini yang baru
        $search = $request->input('search');

        $jadwalgurus = Jadwalguru::with('jurusan')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('no_jadwalguru', 'like', "%{$search}%")
                        ->orWhere('masuk', 'like', "%{$search}%")
                        ->orWhere('keterlambatan', 'like', "%{$search}%")
                        ->orWhere('keterangan', 'like', "%{$search}%")
                        ->orWhere('hari', 'like', "%{$search}%")
                        ->orWhere('pulang', 'like', "%{$search}%")
                        ->orWhereHas('jurusan', function ($q2) use ($search) {
                            $q2->where('no_jurusan', 'like', "%{$search}%");
                        });
                });
            })->paginate(5);


        //ini yang lama 
        //  // Ambil query pencarian dari request
        // $search = $request->input('search');
        // // $paginate = Jadwalguru::paginate(5);
        // $jadwalgurus = Jadwalguru::with('jurusan')->when($search,function($query,$search) {
        //     return $query->where('no_jadwalguru','like',"%{$search}%")
        //     ->orWhere('masuk','like',"%{$search}%")
        //     ->orWhere('keterlambatan','like',"%{$search}%")
        //     ->orWhere('id_jurusan','like',"%{$search}%")
        //     ->orWhere('keterangan','like',"%{$search}%")
        //     ->orWhere('hari','like',"%{$search}%")
        //     ->orWhere('pulang','like',"%{$search}%");
        // })->paginate(5);
        return view('jadwal guru.index', compact('jadwalgurus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusans = Jurusan::all();
    //    dd($jurusans);
        return view('jadwal guru.create', compact('jurusans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'no_jadwalguru' => 'required',
            'masuk' => 'required',
            'pulang' => 'required',
            'keterlambatan' => 'required',
            'id_jurusan' => 'required|exists:jurusans,id', // sesuaikan nama tabel/kolom
            'keterangan' => 'required',
            'hari' => 'required',
        ]);
        JadwalGuru::create($request->all());
        return redirect()->route('jadwalguru.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $show = Jadwalguru::findOrFail($id);
         $jurusans = Jurusan::all();
         return view('jadwal guru.show',compact('show','jurusans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jadwaledit = Jadwalguru::findOrFail($id);
        $jurusans = Jurusan::all();
        return view('jadwal guru.edit', compact('jadwaledit', 'jurusans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jadwalupdate = Jadwalguru::findOrFail($id);
        $request->validate([
            'no_jadwalguru' => 'required',
            'masuk' => 'required',
            'pulang' => 'required',
            'keterlambatan' => 'required',
            'id_jurusan' => 'required|exists:jurusans,id', // sesuaikan nama tabel/kolom
            'keterangan' => 'required',
            'hari' => 'required',
        ]);
        $jadwalupdate->update($request->all());
        return redirect()->route('jadwalguru.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwalhapus = Jadwalguru::findOrFail($id);
        $jadwalhapus->delete();
        return redirect()->route('jadwalguru.index');
    }
}
