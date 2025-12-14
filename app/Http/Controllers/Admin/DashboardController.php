<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // last month range
        $start = Carbon::now()->subMonthNoOverflow()->startOfMonth();
        $end = (clone $start)->endOfMonth();

        // bagi dalam 4 minggu (1-7, 8-14, 15-21, 22-end)
        $weeks = [
            [$start->copy()->day(1)->startOfDay(), $start->copy()->day(7)->endOfDay()],
            [$start->copy()->day(8)->startOfDay(), $start->copy()->day(14)->endOfDay()],
            [$start->copy()->day(15)->startOfDay(), $start->copy()->day(21)->endOfDay()],
            [$start->copy()->day(22)->startOfDay(), $end->copy()->endOfDay()],
        ];

        $labels = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
        $salesData = [];

        foreach ($weeks as [$from, $to]) {
            $sum = DB::table('transactions')
                ->where('status', 'verified')
                ->whereBetween('verified_at', [$from, $to])
                ->sum('amount');

            $salesData[] = (float)$sum;
        }

        // transactions approved/rejected in last month
        $approved = DB::table('transactions')
            ->where('status', 'verified')
            ->whereBetween('verified_at', [$start, $end])
            ->count();

        $rejected = DB::table('transactions')
            ->where('status', 'rejected')
            ->whereBetween('updated_at', [$start, $end])
            ->count();

        $txnStatus = ['approved' => $approved, 'rejected' => $rejected];

        // top 3 menu
        $topMenus = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('menu', 'order_items.menu_id', '=', 'menu.id')
            ->whereBetween('orders.created_at', [$start, $end])
            ->select('menu.namaMenu', DB::raw('sum(order_items.quantity) as total_qty'))
            ->groupBy('menu.id', 'menu.namaMenu')
            ->orderByDesc('total_qty')
            ->limit(3)
            ->get();

        return view('admin.index', compact('labels', 'salesData', 'txnStatus', 'topMenus'));
    }
}
