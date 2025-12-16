<x-layout>
    <!-- JUDUl FORM -->
    <section class="py-5">
        <div class="container">
            <h2 class="fw-bold mb-4 text-center">Form Pemesanan</h2>
            <div class="row">
                <div class="col-md-6">
                    <form id="formPesanan" action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input
                                name="name"
                                id="inputName"
                                type="text"
                                class="form-control"
                                placeholder="Masukkan nama kamu"
                                value="{{ auth()->user()->name ?? '' }}"
                                required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input
                                name="phone"
                                id="inputPhone"
                                type="text"
                                class="form-control"
                                placeholder="08xxxxxxxxxx"
                                value="{{ auth()->user()->phone ?? '' }}"
                                required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat Pengiriman</label>
                            <textarea name="address" id="inputAddress" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Pemesanan</label>
                            <input name="date" id="inputDate" type="date" class="form-control" required />
                        </div>

                        <button
                            type="submit"
                            class="btn btn-hanania w-100 fw-semibold rounded-pill py-2"
                            id="ajukanPesanan">
                            Ajukan Pesanan
                        </button>
                    </form>
                </div>

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 p-3">
                        <h5 class="fw-bold mb-3">Rincian Pesanan</h5>
                        <div id="orderSummary">
                            <p class="text-muted">Belum ada item di keranjang.</p>
                        </div>
                        <hr />
                        <div class="d-flex justify-content-between">
                            <strong>Subtotal</strong>
                            <strong id="orderSubtotal">Rp0</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ======= POPUP BERHASIL ======= -->
    <div
        class="modal fade"
        id="popupBerhasil"
        tabindex="-1"
        aria-labelledby="popupLabel"
        aria-hidden="true"
        data-bs-backdrop="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4 rounded-4 border-0 shadow-lg">
                <div class="modal-body">
                    <i
                        class="bi bi-check-circle-fill text-success"
                        style="font-size: 3rem;"></i>
                    <h5 class="mt-3 fw-bold">Pesanan Berhasil Dikirim!</h5>
                    <p class="text-muted mb-3">
                        Pesanan Anda telah berhasil dikirim ke
                        <strong>Hanania</strong> dan sedang menunggu konfirmasi.
                    </p>
                    <button
                        type="button"
                        class="btn btn-success rounded-pill px-4 fw-semibold"
                        data-bs-dismiss="modal">
                        Oke
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</x-layout>