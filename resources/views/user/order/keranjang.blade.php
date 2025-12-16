<x-layout>
    <!-- ==================== KERANJANG ==================== -->
    <section class="py-5 bg-cream">
        <div class="container">
            <h2 class="fw-bold text-bata mb-4">Keranjang Belanja</h2>
            <div class="row g-4">
                <!-- ======== DAFTAR PRODUK ======== -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <div id="cartContainer">
                            <!-- Items akan dimuat di sini -->
                        </div>
                        <div id="emptyCartMessage" class="alert alert-info text-center py-4">
                            <i class="bi bi-cart-x fs-4"></i><br>
                            <p class="mt-2 mb-0">Keranjang belanja Anda kosong. <a href="{{ route('menu') }}" class="fw-bold">Lanjutkan belanja</a></p>
                        </div>
                    </div>
                </div>

                <!-- ======== RINGKASAN PESANAN ======== -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4" id="summaryCard" style="display: none;">
                        <h5 class="fw-bold text-bata mb-3">Ringkasan Pesanan</h5>
                        <ul class="list-unstyled">
                            <li class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span> <strong id="subtotalAmount">Rp 0</strong>
                            </li>
                            <hr />
                            <li class="d-flex justify-content-between mb-3">
                                <span class="fw-bold">Total</span>
                                <strong class="text-bata fs-5" id="totalAmount">Rp 0</strong>
                            </li>
                        </ul>
                        <form action="{{ route('pesanan') }}" method="GET">
                            <button
                                type="submit"
                                class="btn btn-hanania w-100 py-2 fw-semibold rounded-pill">
                                Checkout Sekarang
                            </button>
                        </form>

                        <div class="mt-3 small text-muted text-center">
                            <i class="bi bi-shield-check"></i>
                            Pesanan Anda dilindungi oleh <strong>Garansi Hanania</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>