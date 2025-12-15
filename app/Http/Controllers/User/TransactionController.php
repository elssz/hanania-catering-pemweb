<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $transactions = Transaction::with('order.items.menu')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.transactions.index', compact('transactions'));
        // return view('user.transactions.index', compact('payments'));
    }
}
