<x-layout>
    <!-- HEADER -->
    <section class="py-5 text-center bg-cream">
        <div class="container">
            <h2 class="fw-bold text-bata mb-2">Menu Katering Kami</h2>
            <p class="text-muted mb-4">Pilih menu favoritmu, kami siapkan dengan sepenuh hati 🍱</p>

            <div class="d-flex justify-content-center">
                <input 
                    id="searchInput" 
                    type="text" 
                    class="form-control w-50 shadow-sm rounded-pill px-4" 
                    placeholder="Cari menu, misalnya ayam, nasi, sayur..."
                >
            </div>
        </div>
    </section>

    <!-- ALERT -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- MENU -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4" id="menuList">

                @forelse ($menus as $menu)
                <div class="col-lg-3 col-md-4 col-sm-6 menu-item">
                    <div class="card h-100 border-0 shadow-sm rounded-4">

                        <!-- IMAGE -->
                        <img 
                            src="{{ asset('images/menu-placeholder.jpg') }}" 
                            class="card-img-top rounded-top-4"
                            alt="{{ $menu->namaMenu }}"
                        >

                        <!-- BODY -->
                        <div class="card-body text-center">
                            <h6 class="fw-bold mb-1">{{ $menu->namaMenu }}</h6>
                            <span class="text-bata fw-semibold">
                                Rp {{ number_format($menu->harga, 0, ',', '.') }}
                            </span>
                        </div>

                        <!-- ACTION -->
                        <div class="card-footer bg-transparent border-0 px-3 pb-3">
                            <form action="{{ route('cart.add', $menu->id) }}" method="POST">
                                @csrf
                                <div class="d-flex gap-2">
                                    <input 
                                        type="number" 
                                        name="qty" 
                                        class="form-control form-control-sm text-center"
                                        value="1" min="1"
                                    >
                                    <button class="btn btn-hanania w-100 btn-sm">
                                        + Keranjang
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Menu belum tersedia 🍽️
                    </div>
                </div>
                @endforelse

            </div>
        </div>
    </section>
</x-layout>
