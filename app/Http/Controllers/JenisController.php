<?php

namespace App\Http\Controllers;
// import
use App\Models\jenis;
use App\Http\Requests\StorejenisRequest;
use App\Http\Requests\UpdatejenisRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\jenisExport as ExportsJenisExport;
use App\Imports\jenisImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
// turunan (in)
class JenisController extends Controller 
{
    public function index() //property dari class
    {
        $data['jenis'] = jenis::get(); 
        return view('jenis.index')->with($data);
    }
    public function store(StorejenisRequest $request) //param
    {
        jenis::create($request->all());
        return redirect('jenis')->with('success', 'Data jenis berhasil di tambahkan!');
    }
    public function update(UpdateJenisRequest $request, string $id)
    {
        $jenis = jenis::find($id)->update($request->all());
        return redirect('jenis')->with('success', 'Update data berhasil');
    }
    public function destroy($id)
    {
        jenis::find($id)->delete();
        return redirect('jenis')->with('success', 'Data jenis berhasil dihapus!');
    }
    public function exportData()
    {
        $date = date('Y-m-d');
        return excel::download(new ExportsJenisExport, $date . '_jenis.xlsx'); //inheritance new
    }
    public function importData(Request $request)
    {
        Excel::import(new jenisImport, $request->import);
        return redirect()->back()->with('success', 'Import data jenis berhasil');
    }
  public function pdf()
    {
        // Data untuk ditampilkan dalam PDF
        $data = jenis::all(); 
          
        // Render view ke HTML
        $pdf = PDF::loadView('jenis/jenis-pdf', ['jenis'=>$data]); 
        $date = date('Y-m-d');
        return $pdf->download($date.'-data-jenis.pdf');
}
}
