<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function import()
    {
        User::where([
            ['id', '<>', '1'],
            ['id', '<>', '2'],
            ['id', '<>', '3'],
        ])->delete();

        UserRole::where([
            ['user_id', '<>', '1'],
            ['user_id', '<>', '2'],
            ['user_id', '<>', '3'],
        ])->delete();

        Excel::import(new UsersImport, public_path('data-import/users.xlsx'));

        return 'success';
    }
}
