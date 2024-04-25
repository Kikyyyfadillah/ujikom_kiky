<?php

namespace App\Imports;

use App\Models\meja;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class mejaImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        // dd($rows);
        foreach ($rows as $row) {
            meja::create([
                'nomor_meja' => $row['nomor_meja'],
                'kapasitas' => $row['kapasitas'],
                'status' => $row['status'],
            ]);
        }
    }
}
