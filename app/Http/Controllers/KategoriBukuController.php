<?php

namespace App\Http\Controllers;

use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class KategoriBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.kategori-buku');
    }

    public function apiKategori(Request $request)
    {
        $kategoribuku = KategoriBuku::select('*');
            // ->join('buku', 'buku.id', 'buku_id')
            // ->where('user_id', $queryId);


        return datatables()->of($kategoribuku)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    return view('layouts.kategori-buku-create');
}

public function store(Request $request)
{
    $request->validate([
        'nama_kategori' => 'required|string|max:255|unique:kategori_buku,nama_kategori',
    ]);

    KategoriBuku::create([
        'nama_kategori' => $request->nama_kategori,
    ]);

    return redirect()->route('kategori.index')->with('success', 'Kategori buku berhasil ditambahkan.');
}

public function show($id)
{
    $kategori = KategoriBuku::findOrFail($id);
    return view('layouts.kategori-buku-show', compact('kategori'));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
