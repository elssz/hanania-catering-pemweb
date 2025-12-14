<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = DB::table('users')->pluck('id')->toArray();
        $menus = DB::table('menu')->get()->keyBy('id');

        if (empty($users) || $menus->isEmpty()) {
            return;
        }

        $daysBack = 30; // 30 hari terakhir
        $ordersToCreate = 30;

        for ($i = 0; $i < $ordersToCreate; $i++) {
            $userId = $users[array_rand($users)];
            $createdAt = Carbon::now()->subDays(rand(0, $daysBack))->subHours(rand(0, 23))->subMinutes(rand(0, 59));

            $orderId = DB::table('orders')->insertGetId([
                'user_id' => $userId,
                'total' => 0,
                'status' => 'awaiting_payment',
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            $itemsCount = rand(1, 5);
            $total = 0;
            for ($j = 0; $j < $itemsCount; $j++) {
                $menu = $menus->random();
                $qty = rand(1, 4);
                $subtotal = $menu->harga * $qty;
                $total += $subtotal;

                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'menu_id' => $menu->id,
                    'quantity' => $qty,
                    'price' => $menu->harga,
                    'subtotal' => $subtotal,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);
            }

            DB::table('orders')->where('id', $orderId)->update(['total' => $total]);

            // transaction status
            $createTxn = rand(0, 100) < 90;
            if ($createTxn) {
                $statuses = ['pending', 'verified', 'rejected'];
                $status = $statuses[array_rand($statuses)];
                $txnCreatedAt = (clone $createdAt)->addHours(rand(1, 72));

                $txnId = DB::table('transactions')->insertGetId([
                    'order_id' => $orderId,
                    'user_id' => $userId,
                    'amount' => $total,
                    'payment_method' => 'bank_transfer',
                    'status' => $status,
                    'proof' => null,
                    'created_at' => $txnCreatedAt,
                    'updated_at' => $txnCreatedAt,
                ]);

                if ($status === 'verified') {
                    DB::table('orders')->where('id', $orderId)->update(['status' => 'paid']);
                    DB::table('transactions')->where('id', $txnId)->update([
                        'verified_by' => DB::table('users')->where('role_id', DB::table('roles')->where('name', 'admin')->value('id'))->value('id'),
                        'verified_at' => (clone $txnCreatedAt)->addHours(rand(1, 48)),
                    ]);
                }
            }
        }
    }
}
