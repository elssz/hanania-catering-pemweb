<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [];
        $categories = ['Paket Makanan', 'Paket Snack', 'Paket Minuman', 'Paket Tumpeng'];

        // Create a small set of menus (10)
        for ($i = 1; $i <= 10; $i++) {
            $menus[] = [
                'namaMenu' => "Menu Example $i",
                'harga' => rand(15000, 200000),
                'kategori' => $categories[array_rand($categories)],
            ];
        }

        DB::table('menu')->insert($menus);
    }
}
