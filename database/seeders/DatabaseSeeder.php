<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::insert([
            [
                'name' => 'Administrator',
                'email' => 'phamle21@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin'), // password
                'remember_token' => Str::random(10),
                'phone' => '0941649826',
                'status' => 'Active',
                'gender' => 'Male',
            ],
            [
                'name' => 'Customer',
                'email' => 'customer@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123123'), // password
                'remember_token' => Str::random(10),
                'phone' => '0941649825',
                'status' => 'Active',
                'gender' => 'Male',
            ]
        ]);

        User::factory(10)->create();

        Role::insert([
            ['name' => 'Admin'],
            ['name' => 'Team Manager'],
            ['name' => 'Player'],
            ['name' => 'Sponsor'],
            ['name' => 'Referee'],
            ['name' => 'Coach'],
            ['name' => 'Normal User'],
        ]);
        Permission::insert([
            ['name' => 'All Permission'],
            ['name' => 'Create Tournament'],
            ['name' => 'Add New User'],
            ['name' => 'Delete User'],
            ['name' => 'Edit User'],
            ['name' => 'Restore User'],
            ['name' => 'Export'],
        ]);

        UserRole::insert([
            [
                'user_id' => 1,
                'role_id' => 1
            ],
            [
                'user_id' => 2,
                'role_id' => 6
            ]
        ]);

        PermissionRole::factory(10)->create();
        UserRole::factory(10)->create();


    }
}
