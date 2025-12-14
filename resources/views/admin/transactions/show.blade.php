<x-layout>
    <div class="container py-5">
        <h2>Transaksi #{{ $transaction->id }}</h2>

        <div class="card p-4 mb-3">
            <p><strong>Order:</strong> {{ $transaction->order->id }}</p>
            <p><strong>User:</strong> {{ $transaction->user->nama }} ({{ $transaction->user->email }})</p>
            <p><strong>Amount:</strong> Rp {{ number_format($transaction->amount,0,',','.') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($transaction->status) }}</p>
            <p><strong>Payment Method:</strong> {{ $transaction->payment_method ?? '-' }}</p>
            <p><strong>Proof:</strong>
                @if($transaction->proof)
                    <a href="{{ asset($transaction->proof) }}" target="_blank">Lihat bukti</a>
                @else
                    -
                @endif
            </p>
            <hr>
            <h5>Order Items</h5>
            <ul>
                @foreach($transaction->order->items as $item)
                    <li>{{ $item->menu->namaMenu }} x {{ $item->quantity }} - Rp {{ number_format($item->subtotal,0,',','.') }}</li>
                @endforeach
            </ul>
        </div>

        <div class="d-flex gap-2">
            <form action="{{ route('admin.transactions.verify', $transaction) }}" method="POST">
                @csrf
                <input type="hidden" name="action" value="verify">
                <button class="btn btn-success">Verifikasi Pembayaran</button>
            </form>

            <form action="{{ route('admin.transactions.verify', $transaction) }}" method="POST">
                @csrf
                <input type="hidden" name="action" value="reject">
                <button class="btn btn-danger">Tolak Pembayaran</button>
            </form>

            <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</x-layout>
