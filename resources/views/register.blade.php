<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Hanania Katering</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    @vite(['resources\css\app.css','resources\js\app.js'])

    <!-- CSS kamu -->
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-cream">

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card p-4 shadow" style="width: 450px; border-radius: 15px;">
            <h3 class="text-center mb-3 text-bata fw-bold">Daftar Akun</h3>

            <form method="POST" action="{{ route('register.post') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input name="nama" value="{{ old('nama') }}" type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan nama kamu">
                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input name="email" value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input name="phone" value="{{ old('phone') }}" type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="08xxxxxxxxxx">
                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Buat password">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <input name="password_confirmation" type="password" class="form-control" placeholder="Ulangi password">
                </div>

                <button type="submit" class="btn btn-hanania w-100 mt-2">
                    Daftar
                </button>

                <p class="text-center mt-3">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-bata fw-semibold">Login</a>
                </p>

            </form>
        </div>
    </div>

</body>

</html>