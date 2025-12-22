<x-layout>
    <!-- ==================== KONFIRMASI PESANAN ==================== -->
    <section class="py-5 bg-cream">
        <div class="container">
            <!-- HEADER -->
            <div class="text-center mb-5">
                <div class="mb-3">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                </div>
                <h2 class="fw-bold text-bata mb-2">Pesanan Berhasil Dibuat!</h2>
                <p class="text-muted">Pesanan Anda sedang menunggu konfirmasi dari Hanania</p>
            </div>

            <div class="row g-4">
                <!-- TRACKING & STATUS -->
                <div class="col-lg-8">
                    <!-- NOMOR PESANAN & STATUS -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <p class="text-muted small mb-1">Nomor Pesanan</p>
                                <h5 class="fw-bold text-bata">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h5>
                            </div>
                            @if($order->status_order == 'pending')
                            <span class="badge bg-warning text-dark">
                                <i class="bi bi-clock"></i> Menunggu Konfirmasi
                            </span>
                            @elseif($order->status_order == 'acc')
                            <span class="badge bg-info">
                                <i class="bi bi-credit-card"></i> Menunggu Pembayaran
                            </span>
                            @elseif($order->status_order == 'reject')
                            <span class="badge bg-primary">
                                <i class="bi bi-hourglass-split"></i> Pesanan Ditolak
                            </span>
                            @elseif($order->status_order == 'complited')
                            <span class="badge bg-success">
                                <i class="bi bi-check-circle">Pesanan Selesai</i> Selesai
                            </span>
                            @elseif($order->status_order == 'cancelled')
                            <span class="badge bg-success">
                                <i class="bi bi-check-circle">Pesanan Dibatalkan</i> Selesai
                            </span>
                            @else
                            <span class="badge bg-danger">-</span>
                            @endif
                        </div>
                    </div>

                    <!-- TIMELINE STATUS -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                        <h5 class="fw-bold text-bata mb-4">Status Pesanan</h5>
                        <div class="timeline">
                            <!-- Step 1: Pesanan Dibuat -->
                            <div class="timeline-item mb-4">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="timeline-marker bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="bi bi-check"></i>
                                        </div>
                                    </div>
                                    <div class="col ps-3">
                                        <h6 class="fw-bold mb-1">Pesanan Dibuat</h6>
                                        <small class="text-muted">{{ $order->created_at->locale('id')->format('d F Y H:i') }}</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 2: Menunggu Konfirmasi -->
                            <div class="timeline-item mb-4">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="timeline-marker bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="bi bi-clock"></i>
                                        </div>
                                    </div>
                                    <div class="col ps-3">
                                        <h6 class="fw-bold mb-1">Menunggu Konfirmasi</h6>
                                        <small class="text-muted">Admin Hanania sedang memverifikasi pesanan Anda</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3: Dalam Persiapan -->
                            <div class="timeline-item mb-4">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="timeline-marker bg-light border-2 border-secondary text-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="bi bi-hourglass-split"></i>
                                        </div>
                                    </div>
                                    <div class="col ps-3">
                                        <h6 class="fw-bold mb-1">Dalam Persiapan</h6>
                                        <small class="text-muted">Pesanan sedang disiapkan di dapur</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 4: Siap Dikirim -->
                            <div class="timeline-item">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="timeline-marker bg-light border-2 border-secondary text-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="bi bi-truck"></i>
                                        </div>
                                    </div>
                                    <div class="col ps-3">
                                        <h6 class="fw-bold mb-1">Siap Dikirim</h6>
                                        <small class="text-muted">Pesanan siap dikirim ke alamat Anda</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DATA PENGIRIMAN -->
                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <h5 class="fw-bold text-bata mb-3">Data Pengiriman</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p class="text-muted small mb-1">Nama Penerima</p>
                                <p class="fw-semibold">{{ $order->user->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted small mb-1">Nomor Telepon</p>
                                <p class="fw-semibold">{{ $order->user->phone ?? '-' }}</p>
                            </div>
                            <div class="col-12">
                                <p class="text-muted small mb-1">Alamat Pengiriman</p>
                                <p class="fw-semibold">Alamat akan disimpan setelah pembayaran dikonfirmasi</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RINCIAN PESANAN -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 20px;">
                        <h5 class="fw-bold text-bata mb-3">Rincian Pesanan</h5>

                        <!-- DETAIL ITEM -->
                        <div class="mb-3" style="max-height: 300px; overflow-y: auto;">
                            @foreach($order->items as $item)
                            <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                                <div>
                                    <p class="fw-semibold small mb-1">{{ $item->menu->namaMenu }}</p>
                                    <small class="text-muted">{{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}</small>
                                </div>
                                <div class="text-end">
                                    <p class="fw-bold small text-bata">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- TOTAL -->
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-bold">Subtotal</span>
                            <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-bold">Biaya Admin</span>
                            <span>Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold text-bata fs-5">Total</span>
                            <span class="fw-bold text-bata fs-5">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                        </div>
                        <hr>

                        <!-- BUTTON ACTIONS -->
                        <div class="d-grid gap-2">
                            <a href="{{ route('transaksi-saya') }}" class="btn btn-hanania rounded-pill fw-semibold">
                                <i class="bi bi-list-check"></i> Lihat Status Pesanan
                            </a>
                            <a href="{{ route('menu') }}" class="btn btn-outline-secondary rounded-pill fw-semibold">
                                <i class="bi bi-plus-circle"></i> Lanjut Belanja
                            </a>
                        </div>

                        <!-- INFO -->
                        <div class="alert alert-info small mt-3 mb-0">
                            <i class="bi bi-info-circle"></i>
                            <strong>Catatan:</strong> Pesanan akan dikonfirmasi oleh admin dalam waktu 2-3 jam kerja.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .timeline {
            position: relative;
            padding-left: 0;
        }

        .timeline-item {
            margin-left: 0;
        }

        .timeline-marker {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</x-layout>