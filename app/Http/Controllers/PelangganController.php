<?php

namespace App\Http\Controllers;

use App\Exports\pelangganExport;
use App\Models\pelanggan;
use App\Http\Requests\StorepelangganRequest;
use App\Http\Requests\UpdatepelangganRequest;
use App\Imports\pelangganImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;
use PDOException;

class PelangganController extends Controller
{
    public function index()
    {
        // try {
            $data['pelanggan'] = pelanggan::get();
            return view('pelanggan.index')->with($data);
        // } catch (QueryException | Exception | PDOException $error) {
        //     $this->failResponse($error->getMessage(), $error->getCode());
        // }
    }
    public function store(StorepelangganRequest $request)
    {
        pelanggan::create($request->all());
        return redirect('pelanggan')->with('success', 'Data jenis berhasil ditambah');
    }
    public function update(UpdatepelangganRequest $request, string $id)
    {
        $pelanggan = pelanggan::find($id)->update($request->all());
        return redirect('pelanggan')->with('success', 'Update data berhasil');
    }
    public function destroy($id)
    {
        pelanggan::find($id)->delete();
        return redirect('pelanggan')->with('success', 'Data pelanggan berhasil dihapus!');
    }
    public function exportData()
    {
        $date = date('Y-m-d');
        return Excel::download(new pelangganExport, $date . '_pelanggan.xlsx');
    }
    public function importData()
    {
        Excel::import(new pelangganImport, request()->file('import'));
        return redirect(request()->segment(1))->with('success', 'Import data pelanggan berhasil');
    }
    public function pdf()
    {
        $pelanggan = pelanggan::all();
        $pdf = Pdf::loadView('pelanggan.data', compact('pelanggan'));
        return $pdf->download('pelanggan.pdf');
    }
}
