<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(\Database\Seeders\RolesTableSeeder::class);
        $this->call(\Database\Seeders\UsersTableSeeder::class);
        $this->call(\Database\Seeders\OrderTransactionSeeder::class);
        $this->call(\Database\Seeders\MenusTableSeeder::class);
        $this->call(\Database\Seeders\OrdersTableSeeder::class);
    }
}
