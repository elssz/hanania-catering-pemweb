<x-layout>

    <!-- ============ HEADER ============ -->
    <header class="text-center py-5 bg-cream">
        <div class="container">
            <h1 class="fw-bold text-bata">Hubungi Kami</h1>
            <p class="text-muted">Butuh bantuan? Kami siap membantu Anda setiap hari.</p>
        </div>
    </header>

    <!-- ============ INFORMASI KONTAK ============ -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4 justify-content-center text-center">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-4 h-100">
                        <h5 class="fw-semibold text-bata mb-3">📞 Telepon / WhatsApp</h5>
                        <p>Hubungi kami di nomor berikut:</p>
                        <p class="fw-bold">+62 896-3122-1745</p>
                        <a href="https://wa.me/6289631221745?text=Halo%20Admin,%20saya%20ingin%20bertanya%20tentang%20pesanan%20Hanania%20Catering"
                            target="_blank" class="btn btn-hanania">Chat via WhatsApp</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-4 h-100">
                        <h5 class="fw-semibold text-bata mb-3">📧 Email</h5>
                        <p>Kirim pertanyaan atau keluhan Anda ke:</p>
                        <p class="fw-bold">*CONTOHhanania.catering@gmail.com</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-4 h-100">
                        <h5 class="fw-semibold text-bata mb-3">📍 Alamat</h5>
                        <p>Jl. Teluk Bone Utara no 10, Surabaya</p>
                        <p>Senin - Minggu (09.00 - 22.00)</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ FORM KONTAK CEPAT ============ -->
    <section class="py-5 bg-white">
        <div class="container">
            <h3 class="fw-bold text-center text-bata mb-4">Kirim Pesan Cepat</h3>
            <form id="contactForm" class="mx-auto" style="max-width: 600px;">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" placeholder="Masukkan nama Anda" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Masukkan email Anda" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Pesan</label>
                    <textarea class="form-control" id="pesan" rows="4" placeholder="Tulis pertanyaan atau pesan Anda..."
                        required></textarea>
                </div>
                <button type="submit" class="btn btn-hanania px-4 py-2">Kirim Pesan</button>
            </form>
        </div>
    </section>

    <!-- ============ FAQ / BANTUAN ============ -->
    <section class="py-5 bg-cream">
        <div class="container">
            <h3 class="fw-bold text-center text-bata mb-4">Bantuan & Pertanyaan Umum</h3>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse1">
                            Bagaimana cara memesan catering?
                        </button>
                    </h2>
                    <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Anda bisa memilih menu di halaman <a href="menu.html">Menu Catering</a>, lalu klik tombol
                            “Tambah ke Keranjang” dan lanjut ke halaman Pesanan.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse2">
                            Apakah bisa custom menu atau jumlah porsi?
                        </button>
                    </h2>
                    <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Ya, Anda bisa menyesuaikan menu dan porsi. Silakan hubungi admin melalui WhatsApp untuk
                            permintaan khusus.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq3">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse3">
                            Metode pembayaran apa saja yang tersedia?
                        </button>
                    </h2>
                    <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Pembayaran bisa dilakukan melalui transfer bank atau virtual account yang tersedia di
                            halaman pembayaran.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>