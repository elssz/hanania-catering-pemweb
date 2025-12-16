<x-layout>
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
                        <div class="card-footer bg-transparent border-0">
                            <button type="button"
                                class="btn btn-hanania w-100 add-to-cart"
                                data-bs-toggle="modal"
                                data-bs-target="#cartModal"
                                data-id="{{ $menu->id }}"
                                data-name="{{ $menu->namaMenu }}"
                                data-price="{{ $menu->harga }}">
                                + Tambah Pesanan
                            </button>
                        </div>
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

    <!-- MODAL UNTUK INPUT QUANTITY -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">

                <!-- HEADER -->
                <div class="modal-header bg-light rounded-top-4">
                    <h5 class="modal-title fw-bold text-bata" id="cartModalLabel">
                        Tambah ke Keranjang
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- BODY -->
                <div class="modal-body bg-white px-4 py-3">

                    <!-- INFO MENU -->
                    <div class="card border-0 bg-light rounded-3 mb-3">
                        <div class="card-body text-center">
                            <p class="mb-1 text-muted small">Menu</p>
                            <h6 id="modalMenuName" class="fw-bold text-bata mb-2"></h6>

                            <p class="mb-1 text-muted small">Harga Satuan</p>
                            <span id="modalMenuPrice" class="fw-semibold"></span>
                        </div>
                    </div>

                    <!-- INPUT JUMLAH -->
                    <form method="POST" id="addToCartForm" action="#">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="menu_id" id="modalMenuId" value="">
                        <div class="input-group mb-3">
                            <button type="button" class="btn btn-outline-secondary" id="decQty">-</button>
                            <input type="number" name="qty" id="modalQty" class="form-control text-center" value="1" min="1">
                            <button type="button" class="btn btn-outline-secondary" id="incQty">+</button>
                        </div>
                    </form>

                    <!-- TOTAL -->
                    <div class="card border-0 bg-success-subtle rounded-3">
                        <div class="card-body text-center">
                            <p class="mb-1 text-muted small">Total Harga</p>
                            <h5 id="modalTotalPrice" class="fw-bold text-success mb-0"></h5>
                        </div>
                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-hanania rounded-pill px-4" id="confirmAddToCart">
                        Tambah ke Keranjang
                    </button>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var cartModal = document.getElementById('cartModal');
        if (!cartModal) return;

        cartModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var name = button.getAttribute('data-name');
            var price = parseFloat(button.getAttribute('data-price')) || 0;

            document.getElementById('modalMenuName').textContent = name;
            document.getElementById('modalMenuPrice').textContent = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(price);
            document.getElementById('modalMenuId').value = id;
            document.getElementById('modalQty').value = 1;
            document.getElementById('modalTotalPrice').textContent = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(price);

            var form = document.getElementById('addToCartForm');
            form.action = '/cart/add/' + id;
            form.dataset.price = price;
        });

        function updateTotal() {
            var form = document.getElementById('addToCartForm');
            var price = parseFloat(form.dataset.price || 0);
            var qty = parseInt(document.getElementById('modalQty').value || 1);
            var total = price * qty;
            document.getElementById('modalTotalPrice').textContent = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(total);
        }

        document.getElementById('incQty').addEventListener('click', function() {
            var el = document.getElementById('modalQty');
            el.value = parseInt(el.value || 1) + 1;
            updateTotal();
        });
        document.getElementById('decQty').addEventListener('click', function() {
            var el = document.getElementById('modalQty');
            el.value = Math.max(1, parseInt(el.value || 1) - 1);
            updateTotal();
        });
        document.getElementById('modalQty').addEventListener('input', updateTotal);

        document.getElementById('confirmAddToCart').addEventListener('click', function() {
            document.getElementById('addToCartForm').submit();
        });
    });
</script>