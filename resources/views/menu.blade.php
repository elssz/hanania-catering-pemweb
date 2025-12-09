<x-layout>
    <div>
        <!-- HEADER -->
        <section class="py-5 text-center bg-cream">
            <div class="container">
                <h2 class="fw-bold text-bata mb-3">Menu Katering Kami</h2>
                <p class="text-muted">Temukan makanan favoritmu di sini 🍴</p>
                <div class="d-flex justify-content-center mt-4">
                    <input id="searchInput" type="text" class="form-control w-50 shadow-sm" placeholder="Cari menu...">
                </div>
            </div>
        </section>

        <!-- MENU SECTION -->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row g-4" id="menuList">

                    <!-- SNACK -->
                    <div class="col-md-3 menu-item" data-category="Snack">
                        <div class="card menu-card text-center">
                            <a href="detail.html" class="text-decoration-none text-dark">
                                <img src="img/mochifilling.jpg" class="card-img-top" alt="Mochi">
                                <div class="card-body">
                                    <h5 class="menu-title">Mochi Filling</h5>
                                    <p class="menu-desc">Stroberi, oreo, mangga</p>
                                </div>
                            </a>
                            <button class="btn btn-hanania add-to-cart">+ Tambah Pesanan</button>
                        </div>
                    </div>

                    <!-- MAKANAN -->
                    <div class="col-md-3 menu-item" data-category="Makanan">
                        <div class="card menu-card text-center">
                            <a href="detail.html" class="text-decoration-none text-dark">
                                <img src="img/sate.jpg" class="card-img-top" alt="Sate Kambing">
                                <div class="card-body">
                                    <h5 class="menu-title">Sate Kambing</h5>
                                    <p class="menu-desc">Daging empuk bumbu kacang khas Hanania</p>
                                </div>
                            </a>
                            <button class="btn btn-hanania add-to-cart">+ Tambah Pesanan</button>
                        </div>
                    </div>

                    <div class="col-md-3 menu-item" data-category="Makanan">
                        <div class="card menu-card text-center">
                            <a href="detail.html" class="text-decoration-none text-dark">
                                <img src="img/Sate Ayam.jpg" class="card-img-top" alt="Sate Ayam">
                                <div class="card-body">
                                    <h5 class="menu-title">Sate Ayam</h5>
                                    <p class="menu-desc">Ayam panggang dengan saus kacang gurih</p>
                                </div>
                            </a>
                            <button class="btn btn-hanania add-to-cart">+ Tambah Pesanan</button>
                        </div>
                    </div>

                    <div class="col-md-3 menu-item" data-category="Makanan">
                        <div class="card menu-card text-center">
                            <a href="detail.html" class="text-decoration-none text-dark">
                                <img src="img/GulaiKambing.jpg" class="card-img-top" alt="Gulai Kambing">
                                <div class="card-body">
                                    <h5 class="menu-title">Gulai Kambing</h5>
                                    <p class="menu-desc">Kuah kental rempah khas tradisional</p>
                                </div>
                            </a>
                            <button class="btn btn-hanania add-to-cart">+ Tambah Pesanan</button>
                        </div>
                    </div>

                    <div class="col-md-3 menu-item" data-category="Makanan">
                        <div class="card menu-card text-center">
                            <a href="detail.html" class="text-decoration-none text-dark">
                                <img src="img/sopiga.jpg" class="card-img-top" alt="Sop Iga Sapi">
                                <div class="card-body">
                                    <h5 class="menu-title">Sop Iga Sapi</h5>
                                    <p class="menu-desc">Iga sapi lembut kuah gurih</p>
                                </div>
                            </a>
                            <button class="btn btn-hanania add-to-cart">+ Tambah Pesanan</button>
                        </div>
                    </div>

                    <div class="col-md-3 menu-item" data-category="Makanan">
                        <div class="card menu-card text-center">
                            <a href="detail.html" class="text-decoration-none text-dark">
                                <img src="img/sopkikil.jpg" class="card-img-top" alt="Sup Kikil Kambing">
                                <div class="card-body">
                                    <h5 class="menu-title">Sup Kikil Kambing</h5>
                                    <p class="menu-desc">Kikil empuk dengan bumbu segar</p>
                                </div>
                            </a>
                            <button class="btn btn-hanania add-to-cart">+ Tambah Pesanan</button>
                        </div>
                    </div>

                    <div class="col-md-3 menu-item" data-category="Makanan">
                        <div class="card menu-card text-center">
                            <a href="detail.html" class="text-decoration-none text-dark">
                                <img src="img/nasigorengkambing.jpg" class="card-img-top" alt="Nasi Goreng Kambing">
                                <div class="card-body">
                                    <h5 class="menu-title">Nasi Goreng Kambing</h5>
                                    <p class="menu-desc">Nasi goreng bumbu rempah khas Timur Tengah</p>
                                </div>
                            </a>
                            <button class="btn btn-hanania add-to-cart">+ Tambah Pesanan</button>
                        </div>
                    </div>

                    <div class="col-md-3 menu-item" data-category="Makanan">
                        <div class="card menu-card text-center">
                            <a href="detail.html" class="text-decoration-none text-dark">
                                <img src="img/hero.jpg" class="card-img-top" alt="Nasi Box">
                                <div class="card-body">
                                    <h5 class="menu-title">Nasi Box</h5>
                                    <p class="menu-desc">Nasi kuning, liwet, bisa request lauk</p>
                                </div>
                            </a>
                            <button class="btn btn-hanania add-to-cart">+ Tambah Pesanan</button>
                        </div>
                    </div>

                    <!-- TUMPENG -->
                    <div class="col-md-3 menu-item" data-category="Tumpeng">
                        <div class="card menu-card text-center">
                            <a href="detail.html" class="text-decoration-none text-dark">
                                <img src="img/tumpeng.jpg" class="card-img-top" alt="Nasi Tumpeng">
                                <div class="card-body">
                                    <h5 class="menu-title">Nasi Tumpeng</h5>
                                    <p class="menu-desc">Tersedia ukuran besar dan kecil</p>
                                </div>
                            </a>
                            <button class="btn btn-hanania add-to-cart">+ Tambah Pesanan</button>
                        </div>
                    </div>

                    <!-- MINUMAN -->
                    <div class="col-md-3 menu-item" data-category="Minuman">
                        <div class="card menu-card text-center">
                            <a href="detail.html" class="text-decoration-none text-dark">
                                <img src="img/esteler.jpg" class="card-img-top" alt="Es Teler">
                                <div class="card-body">
                                    <h5 class="menu-title">Es Teler All Mix</h5>
                                    <p class="menu-desc">Campuran buah segar, susu, dan kelapa muda</p>
                                </div>
                            </a>
                            <button class="btn btn-hanania add-to-cart">+ Tambah Pesanan</button>
                        </div>
                    </div>

                    <div class="col-md-3 menu-item" data-category="Minuman">
                        <div class="card menu-card text-center">
                            <a href="detail.html" class="text-decoration-none text-dark">
                                <img src="img/Es Melon Biji Selasih.jpg" class="card-img-top" alt="Es Melon Selasih">
                                <div class="card-body">
                                    <h5 class="menu-title">Es Melon Selasih</h5>
                                    <p class="menu-desc">Segarnya perpaduan melon dan biji selasih</p>
                                </div>
                            </a>
                            <button class="btn btn-hanania add-to-cart">+ Tambah Pesanan</button>
                        </div>
                    </div>

                    <div class="col-md-3 menu-item" data-category="Minuman">
                        <div class="card menu-card text-center">
                            <a href="detail.html" class="text-decoration-none text-dark">
                                <img src="img/es degan.jpg" class="card-img-top" alt="Es Degan">
                                <div class="card-body">
                                    <h5 class="menu-title">Es Degan</h5>
                                    <p class="menu-desc">Kelapa muda asli segar alami</p>
                                </div>
                            </a>
                            <button class="btn btn-hanania add-to-cart">+ Tambah Pesanan</button>
                        </div>
                    </div>

                    <div class="col-md-3 menu-item" data-category="Minuman">
                        <div class="card menu-card text-center">
                            <a href="detail.html" class="text-decoration-none text-dark">
                                <img src="img/lemontea.jpg" class="card-img-top" alt="Lemon Tea">
                                <div class="card-body">
                                    <h5 class="menu-title">Lemon Tea</h5>
                                    <p class="menu-desc">Teh lemon segar disajikan dingin</p>
                                </div>
                            </a>
                            <button class="btn btn-hanania add-to-cart">+ Tambah Pesanan</button>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- SCRIPT PENCARIAN -->
        <script>
            const searchInput = document.getElementById('searchInput');
            const menuItems = document.querySelectorAll('.menu-item');
            searchInput.addEventListener('keyup', function() {
                const keyword = this.value.toLowerCase();
                menuItems.forEach(item => {
                    const title = item.querySelector('.menu-title').textContent.toLowerCase();
                    item.style.display = title.includes(keyword) ? 'block' : 'none';
                });
            });
        </script>

        <!-- SCRIPT MASUKAN KERANJANG -->
        <script>
            const buttons = document.querySelectorAll('.add-to-cart');
            buttons.forEach(btn => {
                btn.addEventListener('click', () => {
                    alert('Produk berhasil ditambahkan ke keranjang!');
                });
            });
        </script>
    </div>
</x-layout>