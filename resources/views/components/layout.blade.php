<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hanania Catering</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
    @vite(['resources\css\app.css', 'resources\js\app.js'])
</head>

<body>

    <div class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-lg navbar-custom px-4">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <img src="{{ asset('images\logo.jpg') }}" alt="Logo" width="40" class="me-2">
                    <span class="fw-bold text-white">Hanania Katering</span>
                </a>

                <!-- Toggle Mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menu -->
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav gap-3">
                        @auth
                        @if(optional(auth()->user()->role)->name === 'admin')
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                        </li>
                        @endif
                        @endauth

                        @if(!auth()->check() || auth()->user()->isPelanggan())
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('menu') }}">Menu Katering</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('keranjang') }}">Keranjang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('transaksi-saya') }}">Riwayat</a>
                        </li>
                        @endif

                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        @endguest

                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="flex-fill">{{ $slot }}</main>


        <!-- TOMBOL KONTAK & BANTUAN -->
        <div class="contact-help-wrapper">
            <a href="{{ route('kontak') }}" class="contact-help" title="Kontak & Bantuan Hanania">
                <img src="{{ asset('images/img/assistance_icon_142613.png') }}" alt="Kontak & Bantuan">
            </a>
            <p class="contact-help-label">Kontak & Bantuan</p>
        </div>

        <!-- CHAT ADMIN BUTTON -->
        <div class="chat-admin-wrapper">
            <a href="https://wa.me/6289631221745?text=Halo%20Admin,%20saya%20ingin%20bertanya%20tentang%20pesanan%20Hanania%20Katering."
                class="chat-admin" target="_blank" title="Chat Admin via WhatsApp">
                <img src="{{ asset('images/img/waaaa1.png') }}" alt="Chat Admin">
            </a>
            <p class="chat-label">Chat Admin</p>
        </div>


        <footer class="text-center py-4 text-light mt-auto">
            <small>© 2025 Hanania Katering. All Rights Reserved.</small>
        </footer>

    </div>
</body>

</html>