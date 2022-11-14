<?php

namespace App\Imports;

use App\Models\Ground;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class GroundsImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 3;
    }

    public function model(array $row)
    {
        return new Ground([
            'name' => $row[0],
            'address' => $row[1],
            'price' => $row[2],
        ]);
    }
}
