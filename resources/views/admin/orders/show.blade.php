<x-layout>
    <div class="container py-5">
        <h2>Detail Pesanan #ORD-{{ str_pad($order->id,5,'0',STR_PAD_LEFT) }}</h2>

        <div class="card p-3 mb-3">
            <p><strong>User:</strong> {{ $order->user->name ?? $order->user->email }}</p>
            <p><strong>Total:</strong> Rp {{ number_format($order->total,0,',','.') }}</p>
            <p><strong>Status Pembayaran:</strong> {{ ucfirst($order->status_payment) }}</p>
            <p><strong>Status Pesanan:</strong> {{ ucfirst($order->status_order) }}</p>
        </div>

        <div class="card p-3">
            <h5>Items</h5>
            <ul class="list-group">
                @foreach($order->items as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-bold">{{ $item->menu->namaMenu }}</div>
                            <small>{{ $item->quantity }} × Rp {{ number_format($item->price,0,',','.') }}</small>
                        </div>
                        <div class="fw-bold">Rp {{ number_format($item->subtotal,0,',','.') }}</div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-layout>
