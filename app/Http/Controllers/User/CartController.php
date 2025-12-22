<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request, $menuId)
    {
        $menu = Menu::findOrFail($menuId);

        $qty = (int) $request->input('qty', 1);
        if ($qty < 1) $qty = 1;

        // Ambil / buat cart
        $cart = Order::where('user_id', auth()->id())
            ->where('status_order', 'cart')
            ->first();

        if (!$cart) {
            $cart = Order::create([
                'user_id' => auth()->id(),
                'status_order' => 'cart',
                'status_payment' => '-',
                'total' => 0
            ]);
        }

        // Cek item di cart
        $item = OrderItem::where('order_id', $cart->id)
            ->where('menu_id', $menu->id)
            ->first();

        if ($item) {
            // Update qty
            $item->quantity = $item->quantity + $qty;
            $item->subtotal = $item->quantity * $item->price;
            $item->save();
        } else {
            // Tambah item baru
            OrderItem::create([
                'order_id' => $cart->id,
                'menu_id' => $menu->id,
                'quantity' => $qty,
                'price' => $menu->harga,
                'subtotal' => $menu->harga * $qty
            ]);
        }

        // Update total cart
        $cart->total = OrderItem::where('order_id', $cart->id)
            ->sum(DB::raw('quantity * price'));

        $cart->save();

        return redirect()->route('keranjang')->with('success', 'Menu ditambahkan ke keranjang');
    }

    // Checkout - convert cart to order
    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'date' => 'required|date|after_or_equal:today',
        ]);

        // Get user's cart
        $cart = Order::where('user_id', auth()->id())
            ->where('status_order', 'cart')
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return back()->with('error', 'Keranjang Anda kosong.');
        }

        // Update order with user info and change status to pending
        $cart->status_order = 'pending';
        $cart->save();

        // Update user info if needed
        $user = auth()->user();
        $user->phone = $validated['phone'];
        $user->save();

        return redirect()->route('order.confirmation', $cart->id)->with('success', 'Pesanan berhasil dibuat!');
    }

    // Show order confirmation
    public function confirmation($orderId)
    {
        $order = Order::with(['items.menu', 'user'])
            ->where('user_id', auth()->id())
            ->findOrFail($orderId);

        return view('user.order.confirmation', compact('order'));
    }

    // Remove item from cart
    public function removeItem(Request $request, $itemId)
    {
        $item = OrderItem::findOrFail($itemId);
        $order = Order::findOrFail($item->order_id);

        // Check if user owns this order
        if ($order->user_id !== auth()->id()) {
            return back()->with('error', 'Unauthorized');
        }

        $item->delete();

        // Recalculate total
        $order->total = OrderItem::where('order_id', $order->id)
            ->sum(DB::raw('quantity * price'));
        $order->save();

        return back()->with('success', 'Item dihapus dari keranjang');
    }
}
