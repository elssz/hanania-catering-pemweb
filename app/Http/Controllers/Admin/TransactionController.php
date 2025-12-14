<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('order', 'user')->orderBy('created_at', 'desc')->get();
        return view('admin.transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('order.items.menu', 'user');
        return view('admin.transactions.show', compact('transaction'));
    }

    public function verify(Request $request, Transaction $transaction)
    {
        $action = $request->input('action');

        if ($action === 'verify') {
            $transaction->status = 'verified';
            $transaction->verified_by = Auth::id();
            $transaction->verified_at = now();
            $transaction->save();

            // update order status
            $order = $transaction->order;
            $order->status = 'paid';
            $order->save();

            return redirect()->route('admin.transactions.index')->with('success', 'Transaksi berhasil diverifikasi');
        }

        if ($action === 'reject') {
            $transaction->status = 'rejected';
            $transaction->verified_by = Auth::id();
            $transaction->verified_at = now();
            $transaction->save();

            $order = $transaction->order;
            $order->status = 'awaiting_payment';
            $order->save();

            return redirect()->route('admin.transactions.index')->with('success', 'Transaksi ditolak');
        }

        return back()->withErrors(['action' => 'Invalid action']);
    }
}
