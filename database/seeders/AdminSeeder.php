<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Admin Name',
            'email' => 'admin@gmail.com',
            'user_name'=>'Admin User Name',
            'password'=>Hash::make('123456'),
            'role_id'=>1,
        ]);
    }
}
