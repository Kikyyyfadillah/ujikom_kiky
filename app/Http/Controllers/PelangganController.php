<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use App\Http\Requests\StorepelangganRequest;
use App\Http\Requests\UpdatepelangganRequest;
use Exception;
use Illuminate\Database\QueryException;
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
        return redirect('pelanggan')->with('success', 'Data jenis berhasil dihapus!');
    }
}
