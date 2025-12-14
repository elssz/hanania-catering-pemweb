<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insertOrIgnore([
            ['name' => 'admin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'pelanggan', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
