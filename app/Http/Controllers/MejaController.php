<?php

namespace App\Http\Controllers;

use App\Models\meja;
use App\Http\Requests\StoremejaRequest;
use App\Http\Requests\UpdatemejaRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MejaExport as ExportsmejaExport;
use App\Imports\mejaImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    public function index()
    {
        $data['title'] = 'meja';
        $data['meja'] = meja::get(); //$variabel // [array] 
        return view('meja.index')->with($data);
    }
    public function store(StoremejaRequest $request)
    {
        meja::create($request->all());
        return redirect('meja')->with('success', 'Data meja berhasil di tambahkan!');
    }
    public function update(UpdatemejaRequest $request, string $id)
    {
        $meja = meja::find($id)->update($request->all());
        return redirect('meja')->with('success', 'Update data berhasil');
    }
    public function destroy($id)
    {
        meja::find($id)->delete();
        return redirect('meja')->with('success', 'Data meja berhasil dihapus!');
    }
    public function exportData()
    {
        $date = date('Y-m-d');
        return Excel::download(new ExportsMejaExport, $date . '_meja.xlsx');
    }
    public function importData(Request $request)
    {
        Excel::import(new mejaImport, $request->import);
        return redirect()->back()->with('success', 'Import data meja berhasil');
    }
    public function pdf()
    {
        $meja = meja::all();
        $pdf = Pdf::loadView('meja.data', compact('meja'));
        return $pdf->download('meja.pdf');
    }
}
