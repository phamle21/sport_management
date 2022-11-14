<?php

namespace App\Imports;

use App\Models\Matches;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class MatchesImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 3;
    }
    
    public function model(array $row)
    {
        return new Matches([
            //
        ]);
    }
}
