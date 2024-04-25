<?php

namespace App\Imports;

use App\Models\stok;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class stokImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            stok::create([
                'menu_id' => $row['menu_id'],
                'jumlah' => $row['jumlah'],
            ]);
        }
    }

    public function headerRow()
    {
        return 3;
    }
}
