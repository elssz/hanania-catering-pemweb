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
                    @if(isset($menus) && $menus->isNotEmpty())
                        @foreach($menus as $menu)
                        <div class="col-md-3 menu-item" data-category="{{ $menu->kategori }}">
                            <div class="card menu-card text-center">
                                <a href="#" class="text-decoration-none text-dark">
                                    <img src="{{ asset('images/menu-placeholder.jpg') }}" class="card-img-top" alt="{{ $menu->namaMenu }}">
                                    <div class="card-body">
                                        <h5 class="menu-title">{{ $menu->namaMenu }}</h5>
                                        <p class="menu-desc">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                                    </div>
                                </a>
                                <button class="btn btn-hanania add-to-cart" data-id="{{ $menu->id }}">+ Tambah Pesanan</button>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <div class="alert alert-info">Belum ada menu tersedia.</div>
                        </div>
                    @endif
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