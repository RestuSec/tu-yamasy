<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin TU YAMASY',
            'email' => 'admin@yamasy.sch.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
    }
}