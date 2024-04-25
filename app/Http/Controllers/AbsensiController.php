<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Http\Requests\StoreabsensiRequest;
use App\Http\Requests\UpdateabsensiRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\absensiExport as ExportsAbsensiExport;
use App\Imports\absensiImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index() //fm
    {
        $data['absensi'] = absensi::get(); //$variabel // [array] 
        return view('absensi.index')->with($data);
    }
    public function store(StoreabsensiRequest $request)
    {
        absensi::create($request->all());
        return redirect('absensi')->with('success', 'Data absensi berhasil di tambahkan!');
    }
    public function update(UpdateAbsensiRequest $request, string $id)
    {
        $absensi = absensi::find($id)->update($request->all());
        return redirect('absensi')->with('success', 'Update data berhasil');
    }
    public function destroy($id)
    {
        absensi::find($id)->delete();
        return redirect('absensi')->with('success', 'Data absensi berhasil dihapus!');
    }
    public function exportData()
    {
        $date = date('Y-m-d');
        return Excel::download(new ExportsAbsensiExport, $date . '_absensi.xlsx');
    }
    public function importData(Request $request)
    {
        Excel::import(new absensiImport, $request->import);
        return redirect()->back()->with('success', 'Import data absensi berhasil');
    }
     public function pdf()
    {
        $absensi = absensi::all();
        $pdf = Pdf::loadView('absensi.data', compact('absensi'));
        return $pdf->download('absensi.pdf');
}
    
}
