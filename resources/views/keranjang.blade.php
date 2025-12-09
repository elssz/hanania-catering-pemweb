<x-layout>
    <!-- ==================== KERANJANG ==================== -->
    <section class="py-5 bg-cream">
        <div class="container">
            <h2 class="fw-bold text-bata mb-4">Keranjang Belanja</h2>
            <div class="row g-4">
                <!-- ======== DAFTAR PRODUK ======== -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 p-3">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr class="text-secondary">
                                        <th>Produk</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-end">Total</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Item 1 -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img
                                                    src="img/makanan.jpg"
                                                    alt="Paket Makanan"
                                                    class="rounded-3 me-3"
                                                    width="80"
                                                    height="80"
                                                    style="object-fit: cover" />
                                                <div>
                                                    <h6 class="fw-semibold mb-1 text-bata">
                                                        Paket Nasi Box
                                                    </h6>
                                                    <small class="text-muted">Isi: Nasi, Ayam, Sambal</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div
                                                class="d-flex justify-content-center align-items-center">
                                                <button
                                                    class="btn btn-sm btn-outline-secondary rounded-circle">
                                                    −
                                                </button>
                                                <span class="mx-2 fw-semibold">2</span>
                                                <button
                                                    class="btn btn-sm btn-outline-secondary rounded-circle">
                                                    +
                                                </button>
                                            </div>
                                        </td>
                                        <td class="text-end fw-semibold">Rp45.000</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm text-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Item 2 -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img
                                                    src="img/snack.jpg"
                                                    alt="Snack Box"
                                                    class="rounded-3 me-3"
                                                    width="80"
                                                    height="80"
                                                    style="object-fit: cover" />
                                                <div>
                                                    <h6 class="fw-semibold mb-1 text-bata">
                                                        Snack Box
                                                    </h6>
                                                    <small class="text-muted">Isi: Kue, Air Mineral</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div
                                                class="d-flex justify-content-center align-items-center">
                                                <button
                                                    class="btn btn-sm btn-outline-secondary rounded-circle">
                                                    −
                                                </button>
                                                <span class="mx-2 fw-semibold">1</span>
                                                <button
                                                    class="btn btn-sm btn-outline-secondary rounded-circle">
                                                    +
                                                </button>
                                            </div>
                                        </td>
                                        <td class="text-end fw-semibold">Rp20.000</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm text-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-hanania px-4 mt-3">
                            Perbarui Keranjang
                        </button>
                    </div>
                </div>

                <!-- ======== RINGKASAN PESANAN ======== -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <h5 class="fw-bold text-bata mb-3">Ringkasan Pesanan</h5>
                        <ul class="list-unstyled">
                            <li class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span> <strong>Rp65.000</strong>
                            </li>
                            <!-- <li class="d-flex justify-content-between mb-2">
                  <span>Diskon (10%)</span>
                  <strong class="text-success">-Rp6.500</strong>
                </li> -->
                            <hr />
                            <li class="d-flex justify-content-between mb-3">
                                <span class="fw-bold">Total</span>
                                <strong class="text-bata fs-5">Rp65.000</strong>
                            </li>
                        </ul>
                        <a
                            href="pesanan.html"
                            class="btn btn-hanania w-100 py-2 fw-semibold rounded-pill text-decoration-none">
                            Checkout Sekarang
                        </a>
                        <div class="mt-3 small text-muted text-center">
                            <i class="bi bi-shield-check"></i>
                            Pesanan Anda dilindungi oleh <strong>Garansi Hanania</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>