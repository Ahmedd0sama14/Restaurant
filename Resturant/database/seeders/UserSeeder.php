<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

public function run(): void
{
    $admins = [
        [
            'name' => 'Ahmed Osama',
            'email' => 'ahmed@gmail.com',
            'phone' => '01000000001',
            'role'=> 1,
            'password' => Hash::make('12345678'),
        ],
        [
            'name' => ' Mohamed saad',
            'email' => 'Mohamed saad@gmail.com',
            'phone' => '01000000002',
            'role'=>1,
            'password' => Hash::make('12345678'),
        ],
        [
            'name' => 'Ahmed Said',
            'email' => 'Ahmed Said@gmail.com',
            'phone' => '01000000003',
            'role'=>1,
            'password' => Hash::make('12345678'),
        ],
    ];

    foreach ($admins as $admin) {
        Admin::create($admin);
    }
}
}
