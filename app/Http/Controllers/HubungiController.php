<?php

namespace App\Http\Controllers;

use App\Models\hubungi;
use App\Http\Requests\StorehubungiRequest;
use App\Http\Requests\UpdatehubungiRequest;
use App\Policies\HubungiPolicy;
use GuzzleHttp\Psr7\Request;

class HubungiController extends Controller
{
    public function index()
    {
        return view('hubungi.index');
    }
    public function store(Request $request)
    {
        // Proses pengiriman pertanyaan ke developer
        // Misalnya, simpan pertanyaan ke dalam database atau kirim email ke developer

        return redirect()->route('hubungi.index')->with('success', 'Pertanyaan telah dikirim. Terima kasih!');
    }
}
