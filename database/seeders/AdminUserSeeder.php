<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $exists = DB::table('users')->where('email', 'admin@gmail.com')->exists();

        if (!$exists) {
            DB::table('users')->insert([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('Test@123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}