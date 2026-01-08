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
        $orders = Order::with('items.menu', 'transaction', 'review')
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

    public function uploadProof(Request $request, $orderId)
    {
        $order = Order::where('user_id', auth()->id())->findOrFail($orderId);

        // 1. Cek dulu apakah order sudah di-ACC admin
        if ($order->status_order !== 'acc') {
            return back()->with('error', 'Unggah bukti hanya diperbolehkan ketika pesanan telah disetujui oleh admin.');
        }

        // 2. Cari transaksi berdasarkan order_id (ambil datanya, bukan cuma cek exists)
        $transaction = Transaction::where('order_id', $orderId)->first();

        // 3. Validasi Logika:
        // Jika transaksi ada, punya bukti bayar, DAN statusnya BUKAN reject (artinya sedang pending/verified)
        if ($transaction && $transaction->proof && $transaction->status != 'reject') {
            return back()->with('error', 'Anda telah upload bukti bayar! Mohon tunggu verifikasi.');
        }

        // 4. Jika transaksi BELUM ADA sama sekali, kita buat baru
        if (!$transaction) {
            $transaction = Transaction::create([
                'order_id' => $order->id,
                'user_id' => auth()->id(),
                'amount' => $order->total,
                'payment_method' => $request->input('payment_method', 'transfer'),
                'status' => '-' // Status awal
            ]);
        }

        // 5. Proses Upload File
        if ($request->hasFile('proof')) {
            $request->validate([
                'proof' => 'required|image|max:2048'
            ]);

            // --- [BARU] LOGIKA HAPUS FILE LAMA JIKA REJECT ---
            // Cek jika statusnya reject DAN kolom proof ada isinya
            if ($transaction->status == 'rejected' && $transaction->proof) {
                // Ambil full path dari file lama
                $oldFilePath = public_path($transaction->proof);

                // Cek apakah file fisik benar-benar ada di folder, lalu hapus
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); // Fungsi PHP untuk menghapus file
                }
            }
            // --------------------------------------------------

            $file = $request->file('proof');
            $ext = $file->getClientOriginalExtension();
            $filename = 'order_' . str_pad($order->id, 5, '0', STR_PAD_LEFT) . '_' . time() . '.' . $ext;
            $path = public_path('images/bukti_bayar');

            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            $file->move($path, $filename);

            // Update data transaksi
            // (Otomatis menimpa path lama di database dengan path baru)
            $transaction->proof = 'images/bukti_bayar/' . $filename;
            $transaction->status = 'pending';
            $transaction->save();

            // Update status order
            $order->status_payment = 'pending';
            $order->save();

            return redirect()->route('transaksi-saya')->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi.');
        }

        // Jika user submit tapi tidak ada file (opsional handling)
        return back()->with('error', 'Mohon sertakan file bukti pembayaran.');
    }
}
