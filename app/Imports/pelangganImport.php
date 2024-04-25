<?php

namespace App\Imports;

use App\Models\pelanggan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class pelangganImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        // dd($rows);
        foreach ($rows as $row) {
            pelanggan::create([
                'nama' => $row['nama'],
                'email' => $row['email'],
                'no_telp' => $row['no_telp'],
                'alamat' => $row['alamat'],
            ]);
        }
    }
}
