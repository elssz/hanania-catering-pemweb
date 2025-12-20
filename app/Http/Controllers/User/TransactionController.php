<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Show orders that belong to the authenticated user.
        // Load items and related menu plus any associated transaction.
        $orders = Order::with('items.menu', 'transaction')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        return view('user.transactions.index', compact('orders'));
        // return view('user.transactions.index', compact('payments'));
    }

    // Show order (user)
    public function showOrder($orderId)
    {
        $order = Order::with('items.menu', 'transaction')
            ->where('user_id', auth()->id())
            ->findOrFail($orderId);

        return view('user.transactions.show', compact('order'));
    }

    // Handle upload of payment proof
    public function uploadProof(Request $request, $orderId)
    {
        $order = Order::with('transaction')
            ->where('user_id', auth()->id())
            ->findOrFail($orderId);

        // only allow upload if admin already accepted the order
        if ($order->status_order !== 'accept') {
            return back()->with('error', 'Unggah bukti hanya diperbolehkan ketika pesanan telah disetujui oleh admin.');
        }

        $request->validate([
            'proof' => 'required|image|max:2048'
        ]);

        $file = $request->file('proof');
        $ext = $file->getClientOriginalExtension();
        $filename = 'order_' . str_pad($order->id, 5, '0', STR_PAD_LEFT) . '_' . time() . '.' . $ext;
        $path = public_path('images/bukti_bayar');
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        $file->move($path, $filename);

        // create transaction
        $transaction = Transaction::create([
            'order_id' => $order->id,
            'user_id' => auth()->id(),
            'amount' => $order->total,
            'payment_method' => $request->input('payment_method', 'transfer'),
            'status' => 'pending',
            'proof' => 'images/bukti_bayar/' . $filename,
        ]);

        // update order payment status
        $order->status_payment = 'pending';
        $order->save();

        return redirect()->route('transaksi-saya')->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi.');
    }
}
