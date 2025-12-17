<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Hanania Katering</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources\css\app.css','resources\js\app.js'])
</head>

<body class="bg-cream">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card p-4 shadow" style="width: 420px; border-radius: 15px;">
            <h3 class="text-center mb-3 text-bata fw-bold">Lupa Sandi</h3>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input name="email" value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email kamu">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn btn-hanania w-100 mt-2">Kirim Link Reset</button>

                <p class="text-center mt-3">
                    Sudah ingat sandi?
                    <a href="{{ route('login') }}" class="text-bata fw-semibold">Login</a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>