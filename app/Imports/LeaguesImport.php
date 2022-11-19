<?php

namespace App\Imports;

use App\Models\League;
use App\Models\Matches;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class LeaguesImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 3;
    }

    public function model(array $row)
    {
        return new League([
            'name' => $row[0],
            'notify' => $row[1],
            'description' => $row[2],
            'logo' => $row[3],
            'start' => Carbon::createFromFormat('d/m/Y H:i:s', $row[4])->format('Y-m-d H:i:s'),
            'end' => Carbon::createFromFormat('d/m/Y H:i:s', $row[5])->format('Y-m-d H:i:s'),
            'prize' => $row[6],
            'league_type_id' => $row[7],
            'user_id' => $row[8],
        ]);
    }
}
