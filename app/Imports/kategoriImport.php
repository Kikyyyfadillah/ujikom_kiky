<?php

namespace App\Imports;

use App\Models\kategori;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class kategoriImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        // dd($rows);
        foreach ($rows as $row) {
            kategori::create([
                'nama_kategori' => $row['nama_kategori'],
            ]);
        }
    }
}
