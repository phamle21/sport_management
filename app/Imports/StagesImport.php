<?php

namespace App\Imports;

use App\Models\Stage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StagesImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 3;
    }

    public function model(array $row)
    {
        return new Stage([
            'name' => $row[0],
            'order' => $row[1],
            'league_id' => $row[2],
        ]);
    }
}
