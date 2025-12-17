<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OrderTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = DB::table('users')->where('email', 'pelanggan1@example.com')->value('id') ?? DB::table('users')->value('id');
        $menu = DB::table('menu')->first();

        if (! $menu) {
            $menuId = DB::table('menu')->insertGetId([
                'namaMenu' => 'Sample Menu',
                'harga' => 50000,
                'kategori' => 'Paket Makanan',
            ]);
            $menu = DB::table('menu')->where('id', $menuId)->first();
        }

        $orderId = DB::table('orders')->insertGetId([
            'user_id' => $userId,
            'total' => $menu->harga,
            'status_payment' => 'awaiting_payment',
            'status_order' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('order_items')->insert([
            'order_id' => $orderId,
            'menu_id' => $menu->id,
            'quantity' => 1,
            'price' => $menu->harga,
            'subtotal' => $menu->harga,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('transactions')->insert([
            'order_id' => $orderId,
            'user_id' => $userId,
            'amount' => $menu->harga,
            'payment_method' => 'bank_transfer',
            'status' => 'pending',
            'proof' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
