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

    <!-- MENU + CART SECTION -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                <!-- ============ MENU GRID (8/12) ============ -->
                <div class="col-lg-8">
                    <div class="row g-4" id="menuList">
                        @if(isset($menus) && $menus->isNotEmpty())
                        @foreach($menus as $menu)
                        <div class="col-md-6 menu-item" data-category="{{ $menu->kategori }}">
                            <div class="card menu-card text-center h-100 shadow-sm border-0 rounded-4">
                                <a href="#" class="text-decoration-none text-dark">
                                    <img src="{{ asset('images/menu-placeholder.jpg') }}" class="card-img-top rounded-top-4" alt="{{ $menu->namaMenu }}">
                                    <div class="card-body pb-2">
                                        <h5 class="menu-title fw-bold mb-1">{{ $menu->namaMenu }}</h5>
                                        <p class="menu-desc text-bata fw-bold mb-0">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                                    </div>
                                </a>
                                <div class="card-footer bg-transparent border-0 pb-3">
                                    <button type="button"
                                        class="btn btn-hanania w-100 add-to-cart"
                                        data-bs-toggle="modal"
                                        data-bs-target="#cartModal"
                                        data-id="{{ $menu->id }}"
                                        data-name="{{ $menu->namaMenu }}"
                                        data-price="{{ $menu->harga }}">
                                        <i class="bi bi-plus-circle"></i> Tambah
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

                <!-- ============ CART SIDEBAR (4/12) ============ -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4" id="cartSidebar" style="position: sticky; top: 20px;">
                        <h5 class="fw-bold text-bata mb-3">
                            <i class="bi bi-cart-check"></i> Keranjang Saya
                        </h5>

                        <!-- Items List -->
                        <div id="cartItemsList" class="mb-3" style="max-height: 350px; overflow-y: auto; border-bottom: 2px solid #f0f0f0; padding-bottom: 15px;">
                            <div class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                <small>Keranjang kosong</small>
                            </div>
                        </div>

                        <!-- Summary -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Total Item:</span>
                                <strong id="cartCountBadge" class="badge bg-bata rounded-pill">0</strong>
                            </div>
                            <hr class="my-2" />
                            <div class="d-flex justify-content-between mb-3">
                                <span class="fw-bold">Total Harga:</span>
                                <strong class="text-bata fs-5" id="cartTotalPrice">Rp 0</strong>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <a href="{{ route('keranjang') }}" class="btn btn-hanania w-100 py-2 fw-semibold rounded-pill mb-2">
                            <i class="bi bi-bag-check"></i> Lihat Keranjang
                        </a>
                        <a href="{{ route('menu') }}" class="btn btn-outline-bata w-100 py-2 fw-semibold rounded-pill">
                            <i class="bi bi-arrow-clockwise"></i> Refresh
                        </a>

                        <!-- Status -->
                        <div class="alert alert-light border border-bata mt-3 mb-0 small">
                            <i class="bi bi-info-circle text-bata"></i>
                            <small class="text-bata"><strong>Tip:</strong> Klik "Lihat Keranjang" untuk checkout</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MODAL UNTUK INPUT QUANTITY -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">

                <!-- HEADER -->
                <div class="modal-header bg-light rounded-top-4 border-0">
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
                            <button type="button" class="btn btn-outline-secondary" id="decQty">−</button>
                            <input type="number" name="qty" id="modalQty" class="form-control text-center fw-bold" value="1" min="1">
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
                <div class="modal-footer bg-light rounded-bottom-4 border-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-hanania rounded-pill px-4" id="confirmAddToCart">
                        <i class="bi bi-check-circle"></i> Tambah
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11;">
        <div id="successToast" class="toast align-items-center text-white bg-success border-0 shadow-lg rounded-3" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-check-circle me-2"></i>
                    <span id="toastMessage">Item berhasil ditambahkan</span>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="alert"></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

        // Load cart on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadCartSidebar();
            // Refresh cart every 5 seconds untuk real-time update
            setInterval(loadCartSidebar, 5000);
        });

        // Load cart sidebar via AJAX
        function loadCartSidebar() {
            fetch('{{ route('
                    cart.items ') }}', {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.items.length > 0) {
                        renderCartSidebar(data.items, data.total);
                    } else {
                        document.getElementById('cartItemsList').innerHTML =
                            '<div class="text-center text-muted py-4"><i class="bi bi-inbox fs-4 d-block mb-2"></i><small>Keranjang kosong</small></div>';
                        document.getElementById('cartCountBadge').textContent = '0';
                        document.getElementById('cartTotalPrice').textContent = 'Rp 0';
                    }
                })
                .catch(error => console.error('Error loading cart:', error));
        }

        // Render cart sidebar items
        function renderCartSidebar(items, total) {
            const container = document.getElementById('cartItemsList');
            let html = '';

            items.forEach((item, index) => {
                html += `
                    <div class="d-flex justify-content-between align-items-start mb-3 pb-3 ${index < items.length - 1 ? 'border-bottom' : ''}">
                        <div class="flex-grow-1">
                            <small class="fw-semibold d-block text-dark">${item.name}</small>
                            <small class="text-muted">x${item.quantity}</small>
                        </div>
                        <div class="text-end ms-2">
                            <small class="fw-bold text-bata d-block">Rp ${formatCurrency(item.subtotal)}</small>
                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;
            document.getElementById('cartCountBadge').textContent = items.length;
            document.getElementById('cartTotalPrice').textContent = 'Rp ' + formatCurrency(total);
        }

        // Format currency
        function formatCurrency(value) {
            return new Intl.NumberFormat('id-ID', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(value);
        }

        // Show toast notification
        function showToast(message) {
            const toast = document.getElementById('successToast');
            document.getElementById('toastMessage').textContent = message;
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
        }

        // ============ MODAL LOGIC ============
        const cartModal = document.getElementById('cartModal');

        cartModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const price = parseFloat(button.getAttribute('data-price')) || 0;

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

            const form = document.getElementById('addToCartForm');
            form.action = '/cart/add/' + id;
            form.dataset.price = price;
        });

        function updateModalTotal() {
            const form = document.getElementById('addToCartForm');
            const price = parseFloat(form.dataset.price || 0);
            const qty = parseInt(document.getElementById('modalQty').value || 1);
            const total = price * qty;
            document.getElementById('modalTotalPrice').textContent = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(total);
        }

        document.getElementById('incQty').addEventListener('click', function() {
            const el = document.getElementById('modalQty');
            el.value = parseInt(el.value || 1) + 1;
            updateModalTotal();
        });

        document.getElementById('decQty').addEventListener('click', function() {
            const el = document.getElementById('modalQty');
            el.value = Math.max(1, parseInt(el.value || 1) - 1);
            updateModalTotal();
        });

        document.getElementById('modalQty').addEventListener('input', updateModalTotal);

        document.getElementById('confirmAddToCart').addEventListener('click', function() {
            const form = document.getElementById('addToCartForm');
            const menuName = document.getElementById('modalMenuName').textContent;
            const btn = this;
            const originalHTML = btn.innerHTML;

            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Loading...';
            btn.disabled = true;

            fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: new FormData(form)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast(`${menuName} ditambahkan ke keranjang!`);
                        const modalInstance = bootstrap.Modal.getInstance(cartModal);
                        modalInstance.hide();
                        loadCartSidebar(); // Refresh cart sidebar
                    } else {
                        showToast('Gagal menambahkan item');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Terjadi kesalahan');
                })
                .finally(() => {
                    btn.innerHTML = originalHTML;
                    btn.disabled = false;
                });
        });
    </script>
</x-layout>