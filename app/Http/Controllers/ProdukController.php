<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Http\Requests\StoreprodukRequest;
use App\Http\Requests\UpdateprodukRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\produkExport as ExportsprodukExport;
use App\Imports\produkImport;
use Illuminate\Http\Request;

class produkController extends Controller
{
    public function index()
    {
        $data['produk'] = produk::get();
        return view('produk.index')->with($data);
    }
    public function store(StoreprodukRequest $request)
    {
        produk::create($request->all());
        return redirect('produk')->with('success', 'Data menu berhasil di tambahkan!');
    }
    public function update(UpdateprodukRequest $request, string $id)
    {
        produk::find($id)->update($request->all());
        return redirect('produk')->with('success', 'Update data berhasil');
    }
    public function destroy($id)
    {
        produk::find($id)->delete();
        return redirect('produk')->with('success', 'Data produk berhasil dihapus!');
    }
    public function exportData()
    {
        $date = date('Y-m-d');
        return excel::download(new ExportsprodukExport, $date . '_produk.xlsx');
    }
    public function importData(Request $request)
    {
        Excel::import(new produkImport, $request->import);
        return redirect()->back()->with('success', 'Import data produk berhasil');
    }
}
