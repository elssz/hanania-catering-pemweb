<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hanania Katering</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    @vite(['resources\css\app.css','resources\js\app.js'])

    <!-- CSS kamu -->
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-cream">

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card p-4 shadow" style="width: 420px; border-radius: 15px;">
            <h3 class="text-center mb-3 text-bata fw-bold">Login</h3>

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input name="email" value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email kamu">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password">
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">Tampilkan</button>
                    </div>
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn btn-hanania w-100 mt-2">
                    Login
                </button>

                <p class="text-center mt-3">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-bata fw-semibold">Daftar</a>
                </p>
                <p class="text-center mt-3">
                    Lupa Sandi?
                    <a href="{{ route('password.request') }}" class="text-bata fw-semibold">Reset password</a>
                </p>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
      const toggle = document.getElementById('togglePassword');
      const password = document.getElementById('password');
      if (toggle && password) {
        toggle.addEventListener('click', function () {
          const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
          password.setAttribute('type', type);
          toggle.textContent = type === 'password' ? 'Tampilkan' : 'Sembunyikan';
        });
      }
    });
    </script>
</body>

</html>