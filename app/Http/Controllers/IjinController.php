<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Ijin;
use Illuminate\Http\Request;

class IjinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //paginate 
         $search = $request->input('search');

        $ijins = Ijin::with('guru')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('id_nama', 'like', "%{$search}%")
                        ->orWhereHas('guru', function ($q2) use ($search) {
                            $q2->where('nama_guru', 'like', "%{$search}%");
                        });
                });
            })->paginate(5);
            return view('ijin.index',compact('ijins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gurus = Guru::all();
        return view('ijin.create',compact('gurus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_nama' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_berakhir' => 'required',
        ]);
        Ijin::create($request->all());
        return redirect()->route('ijin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $show = Ijin::findOrFail($id);
        $gurus = Guru::all();
        return view('ijin.show',compact('show','gurus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ijinedit = Ijin::findOrFail($id);
        $gurus = Guru::all();
        return view('ijin.edit',compact('ijinedit','gurus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ijinupdate = Ijin::findOrFail($id);
          $request->validate([
            'id_nama' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_berakhir' => 'required',
        ]);
        $ijinupdate->update($request->all());
        return redirect()->route('ijin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ijindelete = Ijin::findOrFail($id);
        $ijindelete->delete();

        return redirect()->route('ijin.index');
    }
}
