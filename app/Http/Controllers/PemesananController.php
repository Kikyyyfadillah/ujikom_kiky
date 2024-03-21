<?php

namespace App\Http\Controllers;

use App\Models\pemesanan;
use App\Http\Requests\StorepemesananRequest;
use App\Http\Requests\UpdatepemesananRequest;
use App\Models\jenis;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pemesanan'] = pemesanan::orderBy('created_at', 'DESC')->get();
        $jenis = jenis::all();
        return view('pemesanan.index', compact('data', 'jenis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function store(StorepemesananRequest $request)
    {
        $data['pemesanan'] = pemesanan::orderBy('created_at', 'DESC')->get();
        $jenis = jenis::all();
        return view('pemesanan.index', compact('data', 'jenis'));
        pemesanan::create($request->all());
        return redirect('pemesanan')->with('success', 'Data menu berhasil!!');
    }
    public function show(pemesanan $pemesanan)
    {
        //
    }
    public function edit(pemesanan $pemesanan)
    {
        //
    }
    public function update(UpdatepemesananRequest $request, pemesanan $pemesanan)
    {
        //
    }
    public function destroy(pemesanan $pemesanan)
    {
        //
    }
}
