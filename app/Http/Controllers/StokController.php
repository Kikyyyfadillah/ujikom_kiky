<?php

namespace App\Http\Controllers;

use App\Exports\menuExport;
use App\Exports\stokExport;
use App\Models\stok;
use App\Models\menu;
use App\Http\Requests\StorestokRequest;
use App\Http\Requests\UpdatestokRequest;
use App\Imports\stokImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class StokController extends Controller
{
    public function index()
    {
        $data['stok'] = stok::with(['menu'])->get();
        $data['menu'] = menu::get();
        return view('stok.index')->with($data);
    }
    public function store(StoreStokRequest $request)
    { {
            $stok = Stok::where('menu_id', $request->menu_id)->get()->first();
            if (!$stok) {
                Stok::create($request->all());
                return redirect('stok')->with('success', 'Data Stok berhasil di tambahkan!');
            }
            $tambahJumlah = $stok->jumlah;
            $stok->jumlah = (int)$request->jumlah + $tambahJumlah;
            $stok->save();
            return redirect('stok')->with('success', 'Data Stok berhasil di tambahkan!');
        }
    }
    public function update(UpdatestokRequest $request, string $id)
    {
        $stok = stok::find($id)->update($request->all());
        return redirect('stok')->with('success', 'Update data berhasil');
    }
    public function destroy($id)
    {
        stok::find($id)->delete();
        return redirect('stok')->with('success', 'Data stok berhasil dihapus!');
    }
    public function exportData()
    {
        $date = date('Y-m-d');
        return Excel::download(new stokExport, $date . '_stok.xlsx');
    }
    public function importData()
    {
        Excel::import(new stokImport, request()->file('import'));
        return redirect()->back()->with('success', 'Import data stok berhasil');
    }
    public function pdf()
    {
        $stok = stok::all();
        $pdf = Pdf::loadView('stok.data', compact('stok'));
        return $pdf->download('stok.pdf');
    }
}
