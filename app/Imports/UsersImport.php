<?php

namespace App\Imports;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UsersImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 3;
    }

    public function model(array $row)
    {
        $new_user = new User([
            'name' => $row[0],
            'address' => $row[1],
            'avatar' => $row[2],
            'phone' => $row[3],
            'gender' => $row[4],
            'birthday' => date('Y-m-d', strtotime($row[5])),
            'email' => $row[6],
            'status' => $row[7],
            'password' => Hash::make($row[8]),
        ]);

        $role_list = Role::all();
        $excel_roles = explode(", ", $row[9]);
        foreach ($role_list  as $v) {
            if (in_array($v->name, $excel_roles)) {
                UserRole::create([
                    'user_id' => $new_user->id,
                    'role_id' => $v->id
                ]);
            }
        }

        return $new_user;
    }
}
