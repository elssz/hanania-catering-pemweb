<x-layout>
    <!-- ==================== CHECKOUT PAGE ==================== -->
    <section class="py-5 bg-cream">
        <div class="container">
            <h2 class="fw-bold text-bata mb-4 text-center">Konfirmasi & Pengisian Data Pesanan</h2>

            <!-- ERROR MESSAGES -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Ada kesalahan!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('checkout') }}" method="POST" id="checkoutForm">
                @csrf
                <div class="row g-4">
                    <!-- ======== DAFTAR ITEM (8/12) ======== -->
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                            <h5 class="fw-bold text-bata mb-3">
                                <i class="bi bi-list-check"></i> Item Pesanan Anda
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cart->items as $item)
                                            <tr class="border-bottom align-middle">
                                                <td>
                                                    <strong>{{ $item->menu->namaMenu }}</strong><br>
                                                    <small class="text-muted">{{ $item->menu->kategori }}</small>
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
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="alert alert-info mt-3">
                                    <i class="bi bi-info-circle"></i>
                                    <strong>Catatan:</strong> Setelah Anda submit form ini, status pesanan akan berubah dari <strong>CART</strong> menjadi <strong>PENDING</strong>
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <i class="bi bi-exclamation-triangle"></i> Keranjang Anda kosong! <a href="{{ route('menu') }}">Kembali ke menu</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- ======== FORM DATA PENGIRIMAN (4/12) ======== -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm rounded-4 p-4" style="position: sticky; top: 20px;">
                            <h5 class="fw-bold text-bata mb-3">
                                <i class="bi bi-person-check"></i> Data Pengiriman
                            </h5>

                            <!-- Nama -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" 
                                       value="{{ old('name', auth()->user()->nama ?? '') }}" 
                                       required>
                                @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>

                            <!-- Telepon -->
                            <div class="mb-3">
                                <label for="phone" class="form-label fw-semibold">Nomor Telepon</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" 
                                       value="{{ old('phone', auth()->user()->phone ?? '') }}"
                                       placeholder="08xxxxxxxxxx" 
                                       required>
                                @error('phone') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>

                            <!-- Alamat -->
                            <div class="mb-3">
                                <label for="address" class="form-label fw-semibold">Alamat Pengiriman</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                          id="address" name="address" 
                                          rows="3" 
                                          placeholder="Jl. ... No. ..."
                                          required>{{ old('address') }}</textarea>
                                @error('address') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>

                            <!-- Tanggal Pengiriman -->
                            <div class="mb-3">
                                <label for="date" class="form-label fw-semibold">Tanggal Pengiriman</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" 
                                       id="date" name="date" 
                                       value="{{ old('date') }}" 
                                       required>
                                @error('date') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>

                            <hr />

                            <!-- Total Summary -->
                            @if($cart && $cart->items->count() > 0)
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Subtotal:</span>
                                    <strong>Rp {{ number_format($cart->total, 0, ',', '.') }}</strong>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold">Total:</span>
                                    <strong class="text-bata fs-5">Rp {{ number_format($cart->total, 0, ',', '.') }}</strong>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-hanania w-100 py-2 fw-semibold rounded-pill">
                                <i class="bi bi-check-circle"></i> Ajukan Pesanan
                            </button>

                            <!-- Back Button -->
                            <a href="{{ route('keranjang') }}" class="btn btn-outline-bata w-100 py-2 fw-semibold rounded-pill mt-2">
                                <i class="bi bi-arrow-left"></i> Kembali ke Keranjang
                            </a>
                            @else
                            <div class="alert alert-warning">
                                Keranjang kosong
                            </div>
                            @endif

                            <div class="alert alert-light border border-bata mt-3 mb-0">
                                <small class="text-bata">
                                    <i class="bi bi-shield-check"></i> <strong>Aman:</strong> Data Anda dilindungi dengan enkripsi
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script>
        // Set minimum date to today
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('date').setAttribute('min', today);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>
