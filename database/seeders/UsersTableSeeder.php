<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRoleId = DB::table('roles')->where('name', 'admin')->value('id');
        $userRoleId = DB::table('roles')->where('name', 'pelanggan')->value('id');

        // Ensure admin exists
        DB::table('users')->insertOrIgnore([
            'username' => Str::slug('admin') . '-1',
            'password' => Hash::make('adminpassword'),
            'nama' => 'Administrator',
            'email' => 'admin@example.com',
            'phone' => '081200000001',
            'role_id' => $adminRoleId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3 pelanggan users
        for ($i = 1; $i <= 3; $i++) {
            DB::table('users')->insertOrIgnore([
                'username' => Str::slug('pelanggan-' . $i) . '-' . $i,
                'password' => Hash::make('password123'),
                'nama' => 'Pelanggan ' . $i,
                'email' => "pelanggan{$i}@example.com",
                'phone' => '08120000000' . $i,
                'role_id' => $userRoleId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
