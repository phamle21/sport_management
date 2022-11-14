<?php

namespace App\Imports;

use App\Models\Mathces;
use Maatwebsite\Excel\Concerns\ToModel;

class MatchesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Mathces([
            //
        ]);
    }
}
