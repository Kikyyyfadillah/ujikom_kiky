<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Http\Requests\StoredetailtransaksiRequest;
use App\Http\Requests\UpdatedetailtransaksiRequest;
use Exception;
use Illuminate\Database\QueryException;
use App\Exports\laporanExport;
use Barryvdh\DomPDF\PDF;
use Maatwebsite\Excel\Facades\Excel;
use PDOException;

class DetailTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $data['DetailTransaksi'] = DetailTransaksi::get();
            return view('laporan.index')->with($data);
        }
        catch (QueryException | Exception | PDOException $error){
            $this->fsilrespon($error->getMessage(),$error->getCode());
        }
    }
    public function exportData()
    {
        $date = date('Y-m-d');
        return Excel::download(new LaporanExport, $date . '_laporan.xlsx');
    }
    public function pdf()
    {
        // Data untuk ditampilkan dalam PDF
        $data = DetailTransaksi::all();

        // Render view ke HTML
        $pdf = PDF::loadView('laporan/laporan-pdf', ['laporan' => $data]);
        $date = date('Y-m-d');
        return $pdf->download($date . '-data-laporan.pdf');
    }
}