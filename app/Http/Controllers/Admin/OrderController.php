<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // show orders except those in cart or cancelled
        $orders = Order::with('user')->whereNotIn('status_order', ['cart', 'cancelled'])->orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.menu', 'user', 'transaction');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status_order' => 'required|in:pending,acc,reject,processing,completed,cancelled',
        ]);

        $order->status_order = $validated['status_order'];
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Status pesanan diperbarui');
    }
}
