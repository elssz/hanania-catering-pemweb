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
            padding: 0.4rem 0.8rem;
        }
    </style>

    <div class="container my-5">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">
                        <i class="bi bi-receipt"></i> Riwayat Transaksi Saya
                    </h2>
                    <small class="text-muted">
                        <i class="bi bi-person-circle"></i> Nama: <strong>{{ auth()->user()->name }}</strong> |
                        Email: <strong>{{ auth()->user()->email }}</strong>
                    </small>
                </div>
            </div>
        </div>

        @if($transactions->isEmpty())
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="bi bi-info-circle"></i>
            <strong>Belum ada transaksi</strong> - Anda belum melakukan pemesanan apapun.
            <a href="{{ route('home') }}" class="alert-link">Mulai belanja sekarang</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @else
        <div class="row">
            <div class="col-md-12">
                @forelse ($transactions as $trx)
                <div class="card mb-3 shadow-sm border-0">
                    <div class="card-body p-4">
                        {{-- Header dengan Order ID dan Status --}}
                        <div class="row align-items-start mb-3">
                            <div class="col-md-8">
                                <h5 class="mb-1">
                                    <strong>Order #{{ str_pad($trx->order_id, 6, '0', STR_PAD_LEFT) }}</strong>
                                </h5>
                                <small class="text-muted">
                                    <i class="bi bi-calendar-event"></i>
                                    {{ $trx->created_at->format('d M Y') }}
                                    pukul {{ $trx->created_at->format('H:i') }}
                                </small>
                            </div>
                            <div class="col-md-4 text-md-end">
                                @if($trx->status === 'verified')
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle"></i> TERVERIFIKASI
                                </span>
                                @elseif($trx->status === 'pending')
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-clock"></i> MENUNGGU VERIFIKASI
                                </span>
                                @else
                                <span class="badge bg-danger">
                                    <i class="bi bi-x-circle"></i> DITOLAK
                                </span>
                                @endif
                            </div>
                        </div>

                        <hr class="my-3">

                        {{-- Detail Transaksi --}}
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <small class="text-muted d-block">Metode Pembayaran</small>
                                <strong>{{ strtoupper($trx->payment_method) }}</strong>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted d-block">Status Pembayaran</small>
                                @if($trx->status === 'verified')
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle"></i> TERVERIFIKASI
                                    </span>
                                @elseif($trx->status === 'pending')
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-clock"></i> MENUNGGU
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="bi bi-x-circle"></i> DITOLAK
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted d-block">Total Pembayaran</small>
                                <strong class="text-success">Rp {{ number_format($trx->amount, 0, ',', '.') }}</strong>
                            </div>
                        </div>

                        {{-- Detail Item Order --}}
                        <div class="mt-4">
                            <strong class="d-block mb-2">Detail Pesanan:</strong>
                            <div class="table-responsive">
                                <table class="table table-sm table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Menu</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-end">Harga</th>
                                            <th class="text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($trx->order->items as $item)
                                        <tr>
                                            <td>
                                                {{ $item->menu->namaMenu ?? 'Menu Tidak Tersedia' }}
                                            </td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-end">
                                                Rp {{ number_format($item->price, 0, ',', '.') }}
                                            </td>
                                            <td class="text-end">
                                                <strong>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</strong>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-3">
                                                Tidak ada item dalam pesanan ini
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Footer dengan Verifikasi Info --}}
                        @if($trx->status === 'verified' && $trx->verified_at)
                        <div class="alert alert-success alert-sm mt-3 mb-0" role="alert">
                            <small>
                                <i class="bi bi-check-circle"></i>
                                Diverifikasi pada {{ $trx->verified_at}}
                                @if($trx->verifier)
                                oleh <strong>{{ $trx->verifier->name }}</strong>
                                @endif
                            </small>
                        </div>
                        @elseif($trx->status === 'pending')
                        <div class="alert alert-warning alert-sm mt-3 mb-0" role="alert">
                            <small>
                                <i class="bi bi-info-circle"></i>
                                Transaksi Anda sedang diverifikasi oleh admin. Mohon tunggu.
                            </small>
                        </div>
                        @endif
                    </div>
                </div>
                @empty
                {{-- Kosong --}}
                @endforelse
            </div>
        </div>
        @endif
    </div>

</x-layout>