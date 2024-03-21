<?php

namespace App\Imports;

use App\Models\produk;
use Maatwebsite\Excel\Concerns\ToModel;


class produkImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        //dd
        return new produk([
            'nama_produk' => $row['nama_produk'],
            'nama_supplier' => $row['nama_supplier'],
            'harga_beli' => $row['harga_beli'],
            'harga_jual' => $row['harga_jual'],
            'stok' => $row['stok'],
            'keterangan' => $row['keterangan'],
            //
        ]);
    }
    public function headingRow(): int
    {
        return 3;
    }
}
