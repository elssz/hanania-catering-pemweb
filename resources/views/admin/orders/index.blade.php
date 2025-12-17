<x-layout>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Pesanan</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card p-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Total</th>
                        <th>Pembayaran</th>
                        <th>Status Pesanan</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $o)
                    <tr>
                        <td>{{ $o->id }}</td>
                        <td>{{ $o->user->name ?? $o->user->email }}</td>
                        <td>Rp {{ number_format($o->total,0,',','.') }}</td>
                        <td>{{ ucfirst($o->status_payment) }}</td>
                        <td>{{ ucfirst($o->status_order) }}</td>
                        <td>{{ $o->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $o) }}" class="btn btn-sm btn-outline-primary">Lihat</a>

                            <form action="{{ route('admin.orders.updateStatus', $o) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <select name="status_order" class="form-select form-select-sm d-inline-block" style="width:150px; display:inline-block;">
                                    <option value="pending" {{ $o->status_order === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="acc" {{ $o->status_order === 'acc' ? 'selected' : '' }}>Acc</option>
                                    <option value="reject" {{ $o->status_order === 'reject' ? 'selected' : '' }}>Reject</option>
                                    {{-- <option value="processing" {{ $o->status_order === 'processing' ? 'selected' : '' }}>Processing</option> --}}
                                    <option value="completed" {{ $o->status_order === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $o->status_order === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
