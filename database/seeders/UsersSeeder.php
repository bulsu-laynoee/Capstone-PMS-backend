<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
             $user = User::create([
            'id' => 1,
            'name' => "Edward Layno",
            'email' => "edward.layno.13@gmail.com",
            'password' => Hash::make('admin123'),
            'updated_at' => now(),
            'created_at' => now()
        ]);

    }
}
