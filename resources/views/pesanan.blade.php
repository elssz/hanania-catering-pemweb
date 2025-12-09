<x-layout>
    <!-- JUDUl FORM -->
    <section class="py-5">
        <div class="container">
            <h2 class="fw-bold mb-4 text-center">Form Pemesanan</h2>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form id="formPesanan">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Masukkan nama kamu"
                                required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="08xxxxxxxxxx"
                                required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat Pengiriman</label>
                            <textarea class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Pemesanan</label>
                            <input type="date" class="form-control" required />
                        </div>
                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                            id="ajukanPesanan">
                            Ajukan Pesanan
                        </button>
                    </form>
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

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>

    <script>
        document
            .getElementById("formPesanan")
            .addEventListener("submit", function(event) {
                event.preventDefault(); // cegah reload halaman

                // ambil semua input
                const inputs = this.querySelectorAll("input[required]");
                let lengkap = true;

                inputs.forEach((input) => {
                    if (!input.value.trim()) {
                        lengkap = false;
                        input.classList.add("is-invalid");
                    } else {
                        input.classList.remove("is-invalid");
                    }
                });

                if (lengkap) {
                    // tampilkan popupmodal
                    const popup = new bootstrap.Modal(
                        document.getElementById("popupBerhasil")
                    );
                    popup.show();
                    // reset form setelah sukses
                    this.reset();
                } else {
                    alert("Harap isi semua data terlebih dahulu 🙏");
                }
            });
    </script>
</x-layout>