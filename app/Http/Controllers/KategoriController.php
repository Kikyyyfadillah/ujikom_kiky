<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Http\Requests\StorekategoriRequest;
use App\Http\Requests\UpdatekategoriRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\kategoriExport as ExportskategoriExport;
use App\Imports\kategoriImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $data['kategori'] = kategori::get(); //$variabel // [array] 
        return view('kategori.index')->with($data);
    }
    public function store(StorekategoriRequest $request)
    {
        kategori::create($request->all());
        return redirect('kategori')->with('success', 'Data menu berhasil di tambahkan!');
    }
    public function update(UpdatekategoriRequest $request, string $id)
    {
        $kategori = kategori::find($id)->update($request->all());
        return redirect('kategori')->with('success', 'Update data berhasil');
    }
    public function destroy($id)
    {
        kategori::find($id)->delete();
        return redirect('kategori')->with('success', 'Data kategori berhasil dihapus!');
    }
    public function exportData()
    {
        $date = date('Y-m-d');
        return Excel::download(new ExportsKategoriExport, $date . '_kategori.xlsx');
    }
    public function importData(Request $request)
    {
        Excel::import(new kategoriImport, $request->import);
        return redirect()->back()->with('success', 'Import data jenis berhasil');
    }
    public function pdf()
    {
        // Data untuk ditampilkan dalam PDF
        $data = kategori::all();

        // Render view ke HTML
        $pdf = PDF::loadView('kategori/kategori-pdf', ['kategori' => $data]);
        $date = date('Y-m-d');
        return $pdf->download($date . '-data-kategori.pdf');
    }
}
