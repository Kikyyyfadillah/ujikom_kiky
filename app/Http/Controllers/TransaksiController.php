<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use App\Http\Requests\StoretransaksiRequest;
use App\Http\Requests\UpdatetransaksiRequest;
use App\Models\DetailTransaksi;
use App\Models\Jenis;
use Exception;
use GuzzleHttp\Psr7\Query;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use PDOException;

class TransaksiController extends Controller
{
    public function index()
    {
        // $data['jenis'] = Jenis::with(['menu'])->get();
        // return view('transaksi.index')->with($data);
    }
    public function store(StoreTransaksiRequest $request)
    {
        try {
            DB::beginTransaction();
            $last_id = Transaksi::where('tanggal', date('Y-m-d'))->orderBy('created_at', 'desc')->select('id')->first();
            $notrans = $last_id == null ? date('Ymd') . '001' : date('Ymd') . sprintf('%04d', substr($last_id->id, 8, 4) + 1);
            // dd($notrans);
            $insertTransaksi = Transaksi::create([
                'id' => $notrans,
                'tanggal' => date('Y-m-d'),
                'total_harga' => $request->total,
                'metode_pembayaran' => 'cash',
                'keterangan' => ''
            ]);
            if (!$insertTransaksi->exists) return 'error';

            // input detail transaksi
            foreach ($request->orderedList as $detail) {
                //dd($detail);
                $insertDetailTransaksi = DetailTransaksi::create([
                    'transaksi_id' => $notrans,
                    'menu_id' => $detail['id'],
                    'jumlah' => $detail['qty'],
                    'subtotal' => $detail['harga'] * $detail['qty']
                ]);
            }
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Pemesanan berhasil!', 'notrans' => $notrans]);
        } catch (Exception | QueryException | PDOException $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Pemesanan Gagal', "error" => $e->getMessage()]);
        }
    }
    public function faktur($nofaktur)
    {
        try {
            $data['transaksi'] = Transaksi::where('id', $nofaktur)->with(['DetailTransaksi' => function ($query) {
                $query->with('menu');
            }])->first();
            //dd t($ransaksi);
            return view('cetak.faktur')->with(($data));
            // dd($data);
        } catch (Exception | QueryException | PDOException $e) {
            return response()->json(['status' => false, 'message' => 'Pemesanan Gagal']);
        }
    }
    public function update(UpdatetransaksiRequest $request, transaksi $transaksi)
    {
        // $transaksi->update($request->all());

        // return redirect('transaksi')->with('success', 'Update data berhasil!');
    }
    public function destroy(transaksi $transaksi)
    {

        // $transaksi->delete();
        // return redirect('transaksi')->with('success', 'Data transaksi berhasil dihapus!');
    }
}
