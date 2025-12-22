<x-layout>

    <style>
        .alert-sm {
            padding: 0.5rem 0.75rem !important;
            font-size: 0.875rem;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .badge {
            font-size: 0.8rem;
            padding: .4rem 0.8rem;
        }
    </style>

    <div class="container my-6">
        <h4 class="fw-bold mb-4">
            <i class="bi bi-receipt"></i> Riwayat Transaksi
        </h4>

        @forelse ($orders as $order)
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">

                {{-- Header --}}

                @php
                $trx = $order->transaction;
                $trxStatus = optional($trx)->status ?? null;
                @endphp

                <div class="row align-items-center mb-3">

                    {{-- ORDER --}}
                    <div class="col-md-6">
                        <h5 class="mb-1 fw-bold">
                            Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                        </h5>

                        <small class="text-muted d-block mb-2">
                            {{ $trx && $trx->created_at
                ? $trx->created_at->format('d M Y, H:i')
                : $order->created_at->format('d M Y, H:i') }}
                        </small>
                    </div>
                    {{-- Status Order --}}
                    <div class="col-md-2 text-center">
                        <small class="text-muted d-block mb-1">Status Order</small>
                        <span class="badge
                            @if($order->status_order === 'acc')
                                bg-success
                            @elseif($order->status_order === 'processing')
                                bg-primary
                            @elseif($order->status_order === 'pending')
                                bg-warning text-dark
                            @elseif($order->status_order === 'canceled')
                                bg-danger
                            @else
                                bg-secondary
                            @endif
                            px-3">
                            {{ strtoupper($order->status_order ?? 'PENDING') }}
                    </div>

                    {{-- Status Bayar --}}
                    <div class="col-md-2 text-center">
                        <small class="text-muted d-block mb-1">Status Bayar</small>
                        <span class="badge {{ $trxStatus === 'verified' ? 'bg-success' : 'bg-warning text-dark' }} px-3">
                            {{ strtoupper($trxStatus ?? 'PENDING') }}
                        </span>
                    </div>

                    {{-- TOTAL --}}
                    <div class="col-md-2 text-end">
                        <small class="text-muted d-block">Total</small>
                        <strong class="fs-4 text-bata">
                            Rp {{ number_format(optional($order->transaction)->amount ?? $order->total, 0, ',', '.') }}
                        </strong>
                    </div>

                </div>



                <hr>

                {{-- Item --}}
                @foreach ($order->items as $item)
                <div class="d-flex justify-content-between align-items-center mb-3">

                    {{-- KIRI: Foto + Nomor + Nama --}}
                    <div class="d-flex align-items-center">

                        {{-- Nomor --}}
                        <span class="badge rounded-circle bg-secondary me-3"
                            style="width: 26px; height: 26px; display: flex; align-items: center; justify-content: center;">
                            {{ $loop->iteration }}
                        </span>

                        {{-- Foto Menu --}}
                        <img src="{{ asset('storage/' . ($item->menu->foto ?? 'default.jpg')) }}"
                            alt="Menu"
                            class="rounded-3 me-3"
                            style="width: 50px; height: 50px; object-fit: cover;">


                        {{-- Nama Menu --}}
                        <div>
                            <strong>{{ $item->menu->namaMenu ?? 'Menu' }}</strong>
                            <div class="text-muted small">
                                Qty {{ $item->quantity }}
                            </div>
                        </div>
                    </div>

                    {{-- KANAN: Harga --}}
                    <div class="fw-semibold">
                        Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                    </div>

                </div>
                @endforeach


                <hr>

                {{-- Footer --}}
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        Metode: {{ strtoupper(optional($order->transaction)->payment_method ?? '—') }}
                    </small>
                    <a href="{{ route('orders.show', $order->id) }}"
                        class="btn btn-sm btn-outline-bata text-danger rounded-pill">
                        Lihat Detail
                    </a>
                </div>


            </div>
        </div>
        @empty
        <div class="alert alert-info">
            Belum ada transaksi.
        </div>
        @endforelse
    </div>

</x-layout>