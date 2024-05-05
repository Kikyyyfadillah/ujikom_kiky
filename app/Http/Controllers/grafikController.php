<?php

namespace App\Http\Controllers;

use App\Models\detailTransaksi;
use App\Models\menu;
use App\Models\pelanggan;
use App\Models\pemesanan;
use App\Models\stok;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class grafikController extends Controller
{
    public function index(){
    {

    //menampilkan pelanggan
    $pelanggan = pelanggan::get();
    $data['count_pelanggan'] = $pelanggan->count();

    //menampilkan transaksi
    $transaksi = detailTransaksi::get();
    $data['count_transaksi'] = $transaksi->count();

    //tampilkan 5 data pelanggan 
    $data['pelanggan'] = pelanggan::limit(5)->orderBy('created_at', 'desc')->get();

    //tampilkan 5 Top penjualan 
    $data['detailTransaksi'] = detailTransaksi::limit(5)->orderBy('created_at', 'desc')->get();
    $data['stok'] = Stok::limit(5)->orderBy('jumlah', 'asc')->get();
    $transaksi = transaksi::get();
    $data['pendapatan'] = $transaksi->sum('total_harga');
           
    //pendapatan
    $transaksi = transaksi::get();
    $data['pendapatan'] = $transaksi->sum('total_harga');

    return view('grafik')->with($data);
}
}
public function grafik(Request $request)
    {
        // Ambil tanggal dari inputan form
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');

        // Query untuk mendapatkan data transaksi berdasarkan tanggal
        $transaksi = detailTransaksi::whereBetween('tanggal', [$tanggalMulai, $tanggalSelesai])->get();

        // Inisialisasi array untuk data grafik
        $labels = [];
        $data = [];

        // Loop melalui data transaksi
        foreach ($transaksi as $item) {
            // Misalnya, kita akan menggunakan tanggal transaksi sebagai label
            $labels[] = $item->created_at->format('Y-m-d');
            // Jumlah transaksi akan digunakan sebagai data
            $data[] = $item->jumlah_transaksi;
        }

        // Kemudian, kirimkan data ini ke view
    return view('grafik')->with(compact('labels','data'));
}
}