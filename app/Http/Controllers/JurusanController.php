<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
            
   
         // Ambil query pencarian dari request
        $search = $request->input('search');
        // Query untuk mengambil data jurusan dengan pencarian
        $jurusans = Jurusan::when($search, function ($query, $search) {
            return $query->where('jurusan', 'like', "%{$search}%")
            ->orWhere('no_jurusan','like',"%{$search}%");
        })->paginate(5); // Menggunakan pagination
        // Mengembalikan view dengan data jurusans
        return view('jurusan.index',compact('jurusans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_jurusan' => 'required',
            'jurusan' => 'required',
        ]);
        Jurusan::create($request->all());
        return redirect()->route('jurusan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jurusanedit = Jurusan::findOrFail($id);
        return view('jurusan.edit', compact('jurusanedit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jurusanupdate = Jurusan::findOrFail($id);
        $request->validate([
            'no_jurusan' => 'required',
            'jurusan' => 'required',
        ]);
        $jurusanupdate->update($request->all());
        return redirect()->route('jurusan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jurusans = Jurusan::findOrFail($id);
        $jurusans->delete();
        return redirect()->route('jurusan.index');
    }
}
