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
    public function index() //fm
    {
        $data['jenis'] = jenis::get(); //$variabel // [array] 
        return view('jenis.index')->with($data);
    }
    public function store(StorejenisRequest $request)
    {
        jenis::create($request->all());
        return redirect('jenis')->with('success', 'Data menu berhasil di tambahkan!');
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
        return excel::download(new ExportsJenisExport, $date . '_jenis.xlsx');
    }
    public function importData(Request $request)
    {
        Excel::import(new jenisImport, $request->import);
        return redirect()->back()->with('success', 'Import data jenis berhasil');
    }
    public function pdf()
    {
        $jenis = jenis::all();
        $pdf = Pdf::loadView('jenis.data', compact('jenis'));
        return $pdf->download('jenis.pdf');
}
}
