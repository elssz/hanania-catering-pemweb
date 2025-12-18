<x-layout>
    <!-- ==================== KERANJANG ==================== -->
    <section class="py-5 bg-cream">
        <div class="container">
            <h2 class="fw-bold text-bata mb-4">Keranjang Belanja</h2>

            <!-- ERROR / SUCCESS MESSAGES -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row g-4">
                <!-- ======== DAFTAR ITEM KERANJANG (8/12) ======== -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <h5 class="fw-bold text-bata mb-3">
                            <i class="bi bi-cart-check"></i> Item Pesanan
                        </h5>

                        @if($cart && $cart->items->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr class="border-bottom">
                                            <th>Menu</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-right">Harga</th>
                                            <th class="text-right">Subtotal</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cart->items as $item)
                                        <tr class="border-bottom align-middle">
                                            <td>
                                                <strong>{{ $item->menu->namaMenu }}</strong>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-light text-dark">{{ $item->quantity }}</span>
                                            </td>
                                            <td class="text-right">
                                                Rp {{ number_format($item->price, 0, ',', '.') }}
                                            </td>
                                            <td class="text-right fw-bold text-bata">
                                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('cart.item.remove', $item->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus item ini?')">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info text-center py-4">
                                <i class="bi bi-cart-x fs-4 d-block mb-2"></i>
                                <p class="mb-0">Keranjang belanja Anda kosong. <a href="{{ route('menu') }}" class="fw-bold">Lanjutkan belanja</a></p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- ======== RINGKASAN & TOMBOL CHECKOUT (4/12) ======== -->
                <div class="col-lg-4">
                    @if($cart && $cart->items->count() > 0)
                    <div class="card border-0 shadow-sm rounded-4 p-4" style="position: sticky; top: 20px;">
                        <h5 class="fw-bold text-bata mb-3">Ringkasan Pesanan</h5>

                        <!-- Item Summary -->
                        <div class="mb-3 p-3 bg-light rounded-3" style="max-height: 250px; overflow-y: auto;">
                            @foreach($cart->items as $item)
                            <div class="d-flex justify-content-between mb-2">
                                <small>{{ $item->menu->namaMenu }} x{{ $item->quantity }}</small>
                                <small class="fw-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</small>
                            </div>
                            @endforeach
                        </div>

                        <hr />

                        <!-- Total -->
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-bold">Total:</span>
                            <strong class="text-bata fs-5">Rp {{ number_format($cart->total, 0, ',', '.') }}</strong>
                        </div>

                        <!-- Checkout Button -->
                        <a href="{{ route('pesanan') }}" class="btn btn-hanania w-100 py-2 fw-semibold rounded-pill">
                            <i class="bi bi-check-circle"></i> Checkout Sekarang
                        </a>

                        <div class="mt-3 small text-muted text-center">
                            <i class="bi bi-shield-check"></i>
                            Pesanan Anda dilindungi oleh <strong>Garansi Hanania</strong>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>
                @csrf
                <div class="row g-4">
                    <!-- ======== DAFTAR PRODUK & FORM ======== -->
                    <div class="col-lg-8">
                        <!-- Items Keranjang -->
                        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                            <h5 class="fw-bold text-bata mb-3">
                                <i class="bi bi-cart-check"></i> Item Pesanan
                            </h5>
                            <div id="cartContainer">
                                <div class="text-center py-4">
                                    <div class="spinner-border text-bata" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                            <div id="emptyCartMessage" class="alert alert-info text-center py-4" style="display: none;">
                                <i class="bi bi-cart-x fs-4"></i><br>
                                <p class="mt-2 mb-0">Keranjang belanja Anda kosong. <a href="{{ route('menu') }}" class="fw-bold">Lanjutkan belanja</a></p>
                            </div>
                        </div>

                        <!-- Form Checkout -->
                        <div class="card border-0 shadow-sm rounded-4 p-4" id="checkoutFormCard" style="display: none;">
                            <h5 class="fw-bold text-bata mb-3">
                                <i class="bi bi-person-check"></i> Data Pemesan
                            </h5>

                            <!-- Nama -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" 
                                       value="{{ old('name', auth()->user()->name) }}" 
                                       required>
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Telepon -->
                            <div class="mb-3">
                                <label for="phone" class="form-label fw-semibold">Nomor Telepon</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" 
                                       value="{{ old('phone', auth()->user()->phone ?? '') }}" 
                                       required>
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Alamat -->
                            <div class="mb-3">
                                <label for="address" class="form-label fw-semibold">Alamat Pengiriman</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                          id="address" name="address" 
                                          rows="3" required>{{ old('address') }}</textarea>
                                @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Tanggal Pengiriman -->
                            <div class="mb-3">
                                <label for="date" class="form-label fw-semibold">Tanggal Pengiriman</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" 
                                       id="date" name="date" 
                                       value="{{ old('date') }}" required>
                                @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="alert alert-info small">
                                <i class="bi bi-info-circle"></i> 
                                <strong>Status Pesanan:</strong> Ketika Anda submit form ini, status pesanan akan berubah dari <strong>Cart</strong> menjadi <strong>Pending</strong>
                            </div>
                        </div>
                    </div>

                    <!-- ======== RINGKASAN PESANAN ======== -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm rounded-4 p-4" id="summaryCard" style="position: sticky; top: 20px;">
                            <h5 class="fw-bold text-bata mb-3">Ringkasan Pesanan</h5>

                            <!-- Item List -->
                            <div id="summaryItems" class="mb-3" style="max-height: 300px; overflow-y: auto; border-bottom: 1px solid #ddd; padding-bottom: 15px;">
                                <div class="text-center text-muted py-3">
                                    <small>Loading...</small>
                                </div>
                            </div>

                            <hr />

                            <!-- Total -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal</span> 
                                    <strong id="subtotalAmount">Rp 0</strong>
                                </div>
                                <hr />
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="fw-bold">Total</span>
                                    <strong class="text-bata fs-5" id="totalAmount">Rp 0</strong>
                                </div>
                            </div>

                            <!-- Status Info -->
                            <div class="alert alert-light border border-bata mb-3">
                                <small class="text-bata">
                                    <i class="bi bi-info-circle"></i>
                                    <strong>Status Saat Ini:</strong> <span id="statusBadge" class="badge bg-warning">CART</span>
                                    <br>
                                    <strong>Setelah Checkout:</strong> <span class="badge bg-info">PENDING</span>
                                </small>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" 
                                    class="btn btn-hanania w-100 py-2 fw-semibold rounded-pill" 
                                    id="checkoutBtn"
                                    style="display: none;">
                                <i class="bi bi-check-circle"></i> Checkout Sekarang
                            </button>

                            <a href="{{ route('menu') }}" class="btn btn-outline-bata w-100 py-2 fw-semibold rounded-pill mt-2">
                                <i class="bi bi-plus-circle"></i> Lanjutkan Belanja
                            </a>

                            <div class="mt-3 small text-muted text-center">
                                <i class="bi bi-shield-check"></i>
                                Pesanan Anda dilindungi oleh <strong>Garansi Hanania</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Toast Notification -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11;">
        <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body" id="toastMessage">
                    Item berhasil dihapus
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="alert"></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

        // Set minimum date to today
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('date').setAttribute('min', today);

            // Load cart items on page load
            loadCartItems();
        });

        // Load cart items from AJAX
        function loadCartItems() {
            fetch('{{ route('cart.items') }}', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.items.length > 0) {
                    renderCartItems(data.items, data.total);
                    renderSummaryItems(data.items, data.total);
                    document.getElementById('emptyCartMessage').style.display = 'none';
                    document.getElementById('checkoutFormCard').style.display = 'block';
                    document.getElementById('checkoutBtn').style.display = 'block';
                } else {
                    document.getElementById('cartContainer').innerHTML = '';
                    document.getElementById('emptyCartMessage').style.display = 'block';
                    document.getElementById('checkoutFormCard').style.display = 'none';
                    document.getElementById('checkoutBtn').style.display = 'none';
                    document.getElementById('summaryItems').innerHTML = '<small class="text-muted">Belum ada item</small>';
                }
            })
            .catch(error => {
                console.error('Error loading cart:', error);
                document.getElementById('cartContainer').innerHTML = '<div class="alert alert-danger">Gagal memuat keranjang</div>';
            });
        }

        // Render cart items
        function renderCartItems(items, total) {
            const container = document.getElementById('cartContainer');
            let html = '';

            items.forEach(item => {
                html += `
                    <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-semibold">${item.name}</h6>
                            <small class="text-muted">
                                ${item.quantity}x @ Rp ${formatCurrency(item.price)}
                            </small>
                        </div>
                        <div class="text-end ms-3">
                            <div class="fw-bold mb-2">Rp ${formatCurrency(item.subtotal)}</div>
                            <button type="button" class="btn btn-sm btn-outline-danger delete-item-btn" 
                                    data-item-id="${item.id}">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;

            // Add event listeners to delete buttons
            document.querySelectorAll('.delete-item-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-item-id');
                    if (confirm('Hapus item ini dari keranjang?')) {
                        deleteCartItem(itemId);
                    }
                });
            });
        }

        // Render summary items
        function renderSummaryItems(items, total) {
            const container = document.getElementById('summaryItems');
            let html = '';

            items.forEach(item => {
                html += `
                    <div class="d-flex justify-content-between mb-2 small">
                        <span>${item.name} (x${item.quantity})</span>
                        <strong>Rp ${formatCurrency(item.subtotal)}</strong>
                    </div>
                `;
            });

            container.innerHTML = html;
            document.getElementById('subtotalAmount').textContent = 'Rp ' + formatCurrency(total);
            document.getElementById('totalAmount').textContent = 'Rp ' + formatCurrency(total);
        }

        // Delete cart item
        function deleteCartItem(itemId) {
            fetch(`/cart/item/${itemId}/remove`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Item berhasil dihapus dari keranjang');
                    if (data.cartCount === 0) {
                        // Reload page if cart is empty
                        setTimeout(() => loadCartItems(), 1500);
                    } else {
                        loadCartItems();
                    }
                } else {
                    alert('Gagal menghapus item: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus item');
            });
        }

        // Show toast notification
        function showToast(message) {
            const toast = document.getElementById('successToast');
            document.getElementById('toastMessage').textContent = message;
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
        }

        // Format currency
        function formatCurrency(value) {
            return new Intl.NumberFormat('id-ID', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(value);
        }

        // Form submission - change status to pending
        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            // Form akan submit ke route checkout yang sudah update status_order dari 'cart' ke 'pending'
        });
    </script>
</x-layout>