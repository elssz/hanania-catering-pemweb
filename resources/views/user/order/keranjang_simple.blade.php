<x-layout>
    <!-- ==================== KERANJANG ==================== -->
    <section class="py-5 bg-cream">
        <div class="container">
            <h2 class="fw-bold text-bata mb-4">Keranjang Belanja</h2>

            <!-- ERROR / SUCCESS MESSAGES -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row g-4">
                <!-- ======== DAFTAR ITEM KERANJANG (8/12) ======== -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <h5 class="fw-bold text-bata mb-3">
                            <i class="bi bi-cart-check"></i> Item Pesanan
                        </h5>

                        @if($cart && $cart->items->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr class="border-bottom">
                                            <th>Menu</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-right">Harga</th>
                                            <th class="text-right">Subtotal</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cart->items as $item)
                                        <tr class="border-bottom align-middle">
                                            <td>
                                                <strong>{{ $item->menu->namaMenu }}</strong>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-light text-dark">{{ $item->quantity }}</span>
                                            </td>
                                            <td class="text-right">
                                                Rp {{ number_format($item->price, 0, ',', '.') }}
                                            </td>
                                            <td class="text-right fw-bold text-bata">
                                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('cart.item.remove', $item->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus item ini?')">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info text-center py-4">
                                <i class="bi bi-cart-x fs-4 d-block mb-2"></i>
                                <p class="mb-0">Keranjang belanja Anda kosong. <a href="{{ route('menu') }}" class="fw-bold">Lanjutkan belanja</a></p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- ======== RINGKASAN & TOMBOL CHECKOUT (4/12) ======== -->
                <div class="col-lg-4">
                    @if($cart && $cart->items->count() > 0)
                    <div class="card border-0 shadow-sm rounded-4 p-4" style="position: sticky; top: 20px;">
                        <h5 class="fw-bold text-bata mb-3">Ringkasan Pesanan</h5>

                        <!-- Item Summary -->
                        <div class="mb-3 p-3 bg-light rounded-3" style="max-height: 250px; overflow-y: auto;">
                            @foreach($cart->items as $item)
                            <div class="d-flex justify-content-between mb-2">
                                <small>{{ $item->menu->namaMenu }} x{{ $item->quantity }}</small>
                                <small class="fw-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</small>
                            </div>
                            @endforeach
                        </div>

                        <hr />

                        <!-- Total -->
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-bold">Total:</span>
                            <strong class="text-bata fs-5">Rp {{ number_format($cart->total, 0, ',', '.') }}</strong>
                        </div>

                        <!-- Checkout Button -->
                        <a href="{{ route('pesanan') }}" class="btn btn-hanania w-100 py-2 fw-semibold rounded-pill">
                            <i class="bi bi-check-circle"></i> Checkout Sekarang
                        </a>

                        <div class="mt-3 small text-muted text-center">
                            <i class="bi bi-shield-check"></i>
                            Pesanan Anda dilindungi oleh <strong>Garansi Hanania</strong>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>
