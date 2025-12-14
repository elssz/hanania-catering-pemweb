<x-layout>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Transaksi</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card p-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $t)
                    <tr>
                        <td>{{ $t->id }}</td>
                        <td>{{ $t->order->id ?? '-' }}</td>
                        <td>{{ $t->user->nama ?? $t->user->email }}</td>
                        <td>Rp {{ number_format($t->amount,0,',','.') }}</td>
                        <td>{{ ucfirst($t->status) }}</td>
                        <td>{{ $t->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.transactions.show', $t) }}" class="btn btn-sm btn-primary">Lihat</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
