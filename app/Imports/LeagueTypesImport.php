<?php

namespace App\Imports;

use App\Models\LeagueType;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class LeagueTypesImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 3;
    }

    public function model(array $row)
    {
        return new LeagueType([
            'name' => $row[0],
        ]);
    }
}
