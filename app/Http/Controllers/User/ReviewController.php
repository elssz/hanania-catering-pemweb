<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
            'proof' => 'nullable|image|max:2048|mimes:jpg,jpeg,png'
        ]);

        $order = Order::findOrFail($request->order_id);
        if ($order->user_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        $photoPath = null;
        // Menambahkan foto
        if ($request->hasFile('proof')) {
            $file = $request->file('proof');
            $filename = 'review_' . $order->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('images/reviews');

            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $file->move($path, $filename);
            $photoPath = 'images/reviews/' . $filename;
        }
        Review::create([
            'order_id' => $request->order_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'proof' => $photoPath
        ]);

        // //menngubah order menjadi done
        // $order->status_order = 'done';
        // $order->save();

        return back()->with('success', 'Terima kasih atas ulasan Anda!');
    }

    public function update(Request $request, Review $review)
    {
        // Pastikan yang edit adalah pemilik ulasan
        if ($review->order->user_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
            'proof' => 'nullable|image|max:2048|mimes:jpg,jpeg,png'
        ]);

        $dataToUpdate = [
            'rating' => $request->rating,
            'comment' => $request->comment,
        ];

        // mengecek foto ada atau tidak
        if ($request->hasFile('proof')) {
            // Hapus foto lama (kalau ada)
            if ($review->proof && file_exists(public_path($review->proof))) {
                unlink(public_path($review->proof));
            }

            //Upload foto baru
            $file = $request->file('proof');
            $filename = 'review_' . $review->order_id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/reviews'), $filename);

            $dataToUpdate['proof'] = 'images/reviews/' . $filename;
        }

        $review->update($dataToUpdate);

        return back()->with('success', 'Ulasan berhasil diperbarui!');
    }
}
