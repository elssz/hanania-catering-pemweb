<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hanania Catering</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
    @vite(['resources\css\app.css','resources\js\app.js'])
</head>

<body>

    <div>
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-custom px-4">
            <div class="container-fluid">
                <!-- Logo & Brand -->
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <img src="{{ asset('images\logo.jpg') }}" alt="Logo" width="40" class="me-2">
                    <span class="fw-bold text-white">Hanania Katering</span>
                </a>

                <!-- Toggle Mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menu -->
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav gap-3">
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
                            <a class="nav-link" href="{{ route('pesanan') }}">Pesanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- isian -->
    <div>{{ $slot }}</div>

    <!-- ==================== FOOTER ==================== -->
    <footer class="text-center py-4 text-dark">
        <small>© 2025 Hanania Katering. All Rights Reserved.</small>
    </footer>

</body>

</html>