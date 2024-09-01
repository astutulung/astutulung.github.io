<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nama' => 'Admin User',
                'jk' => 'Laki-laki',
                'no_tlpn' => '081234567890',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'admin',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Panitia User',
                'jk' => 'Perempuan',
                'no_tlpn' => '081234567891',
                'email' => 'panitia@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'panitia',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Siswa User',
                'jk' => 'Laki-laki',
                'no_tlpn' => '081234567892',
                'email' => 'siswa@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
