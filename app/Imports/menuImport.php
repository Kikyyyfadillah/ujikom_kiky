<?php

namespace App\Imports;

use App\Models\menu;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class menuImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        // dd($rows);
        foreach ($rows as $row) {
            menu::create([
                'jenis_id' => $row['jenis_id'],
                'nama_menu' => $row['nama_menu'],
                'harga' => $row['harga'],
                'image' => $row['image'],
                'deskripsi' => $row['deskripsi'],
            ]);
        }
    }
}
