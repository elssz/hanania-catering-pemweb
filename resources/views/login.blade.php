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

            <form>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="Masukkan email kamu">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Masukkan password">
                </div>

                <button type="submit" class="btn btn-hanania w-100 mt-2">
                    Login
                </button>

                <p class="text-center mt-3">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-bata fw-semibold">Daftar</a>
                </p>
            </form>
        </div>
    </div>

</body>

</html>