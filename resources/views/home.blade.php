<x-layout>
    <!-- ==================== HERO ==================== -->
    <section class="hero d-flex align-items-center text-light">
        <div class="container d-lg-flex align-items-center justify-content-between">
            <div class="col-lg-6">
                <h1 class="fw-bold mb-3">Hanania Katering</h1>
                <p class="lead mb-4">
                    Rasa Autentik Kambing & Sapi Juara di Setiap Gigitan!"
                    Spesialis masakan kambing dan sapi premium dengan rempah tradisional, empuk, gurih, dan bikin nagih.
                    Dari sate bakar sempurna, gulai kental hangat, hingga nasi tumpeng megah untuk acara istimewa.
                    Nasi Box Custom Pilih menu sesuai selera.
                    Minuman Segar All-Time Favorite Es teler, melon selasih, degan murni, lemon tea.
                    27+ Tahun Melayani Ribuan Acara Sukses:
                    Hajatan keluarga, pernikahan, ulang tahun, gathering kantor.
                </p>
                <a href="{{ route('menu') }}" class="btn btn-light px-4 py-2 fw-semibold">Pesan Sekarang</a>
            </div>
            <div class="col-lg-5 mt-4 mt-lg-0">
                <img src="{{ asset('images/img/hero.jpg') }}" alt="Hero Image"
                    class="img-fluid rounded-circle shadow-lg hero-img" />
            </div>
        </div>
    </section>

    <!-- ==================== KATEGORI ==================== -->
    <section id="kategori" class="kategori text-center py-5">
        <div class="container">
            <h3 class="fw-bold mb-4">Kategori Katering</h3>
            <div class="row g-4 justify-content-center">
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('images/img/mochifilling.jpg') }}" class="card-img-top" alt="Paket Snack" />
                        <div class="card-body">
                            <h5 class="card-title">Paket Snack</h5>
                            <p class="card-text">
                                Beragam snack tradisional dan modern dengan rasa gurih atau
                                manis.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('images/img/minuman.jpg') }}" class="card-img-top" alt="Paket Minuman" />
                        <div class="card-body">
                            <h5 class="card-title">Paket Minuman</h5>
                            <p class="card-text">
                                Tersedia berbagai minuman segar dengan aneka rasa.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('images/img/makanan.jpg') }}" class="card-img-top" alt="Paket Makanan" />
                        <div class="card-body">
                            <h5 class="card-title">Paket Makanan</h5>
                            <p class="card-text">
                                Aneka nasi box dan lauk lengkap untuk berbagai acara.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('images/img/tumpeng.jpg') }}" class="card-img-top" alt="Paket Tumpeng" />
                        <div class="card-body">
                            <h5 class="card-title">Paket Tumpeng</h5>
                            <p class="card-text">
                                Variasi tumpeng yang cocok untuk acara spesial.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('menu') }}" class="btn btn-hanania mt-4 px-4 py-2">Lihat Menu</a>
            </div>
        </div>
    </section>

    <!-- ==================== PORTOFOLIO ==================== -->
    <section class="portofolio py-5 text-light">
        <div class="container d-lg-flex align-items-center justify-content-between">
            <div class="col-lg-6 mb-4 mb-lg-0 ">
                <img src="{{ asset('images/img/sate.jpg') }}" alt="Portofolio" class="img-fluid rounded shadow-lg" />
            </div>
            <div class="col-lg-5">
                <h2 class="portofolio-title">Portofolio</h2>
                <br />
                <h2 class="fw-bold mb-3">Hanania Katering</h2>
                <p>
                    Sejak tahun <strong>1998</strong>, <strong>Hanania Catering</strong> hadir sebagai mitra terpercaya
                    untuk berbagai acara —
                    mulai dari pesta pernikahan, syukuran keluarga, hingga kegiatan korporasi berskala besar.
                    Dengan tim dapur berpengalaman dan bahan baku pilihan, kami memastikan setiap sajian tidak hanya
                    lezat, tetapi juga higienis dan bergizi.
                    Mulai dari <em>sate kambing empuk</em>, <em>nasi box custom</em>, hingga <em>tumpeng eksklusif</em>
                    untuk momen spesial Anda —
                    semua diolah dengan resep turun-temurun dan sentuhan modern.
                </p>
                </p>
                <p>
                    <strong>Alamat:</strong> Jl. Tanjung Perak  Gang II No.12 Surabaya Utara <br />
                    <strong>No. HP:</strong> 08156477865<br />
                    <strong>Media Sosial:</strong> @hananiakatering
                </p>
            </div>
        </div>
    </section>

    <section class="reviews py-5 ketegori">
        <div class="container">
            <div class="text-center mb-5">
                <h3 class="fw-bold ">Kata Mereka Tentang Hanania</h3>
                <p class="text-muted">Kepuasan pelanggan adalah prioritas utama kami</p>
            </div>

            <div class="row g-4 justify-content-center">
                @forelse($reviews as $review)
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm rounded-4 p-3">
                            <div class="card-body">
                                {{-- Header: Foto Profil & Nama --}}
                                <div class="d-flex align-items-center mb-3">
                                    {{-- Avatar Placeholder (Inisial Nama) --}}
                                    <div class="flex-shrink-0">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($review->order->user->nama) }}&background=a34740&color=fff"
                                            alt="User" class="rounded-circle" width="45" height="45">
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.95rem;">
                                            {{ Str::limit($review->order->user->nama, 15) }}
                                        </h6>
                                        <small class="text-muted" style="font-size: 0.75rem;">
                                            {{ $review->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>

                                {{-- Rating Bintang --}}
                                <div class="mb-3 text-warning">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="{{ $i <= $review->rating ? '-fill' : '' }}">☆</i>
                                    @endfor
                                </div>

                                {{-- Komentar --}}
                                <p class="card-text text-secondary small fst-italic">
                                    "{{ Str::limit($review->comment, 100) }}"
                                </p>

                                {{-- Foto Bukti Review--}}
                                @if ($review->proof)
                                    <div class="mt-3 rounded-3 overflow-hidden" style="height: 120px;">
                                        <img src="{{ asset($review->proof) }}" alt="Foto Ulasan"
                                            class="w-100 h-100 object-fit-cover">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Belum ada ulasan saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

</x-layout>
