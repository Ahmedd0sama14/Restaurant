<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Admin::create([
            'name' => 'Super Admin',
            'email'=> 'superadmin@example.com',
            'password' => Hash::make('password'),
            'role' => 3,
            'phone' => '01000000000',

        ]);
    }
}
