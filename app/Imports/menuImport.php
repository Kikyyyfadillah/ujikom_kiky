<?php

namespace App\Imports;

use App\Models\menu;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class menuImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        menu::create([
            'nama_menu' => $row['nama_menu'],
            'jenis' => $row['jenis'],
            'harga' => $row['harga'],
            'image' => $row['image'],
            'deskripsi' => $row['deskripsi'],
        ]);
    }
}
