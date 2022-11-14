<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use App\Imports\OptionsImport;
use App\Models\Option;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OptionController extends Controller
{
    public function import()
    {
        if (count(Option::all()) > 0)
            Option::truncate();

        Excel::import(new OptionsImport, public_path('data-import/options.xlsx'));

        return 'success';

        return redirect()->back();
    }
}
