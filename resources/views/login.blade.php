<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Absensi</title>
    <link rel="icon" href="img/smk17.png">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 100%;
            max-width: 400px;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            background-color: #0d6efd;
            color: white;
            font-weight: bold;
            text-align: center;
            font-size: 1.2rem;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn {
            width: 100%;
            border-radius: 8px;
        }

        .logo {
            width: 60px;
            height: 60px;
            display: block;
            margin: 20px auto 10px auto;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="card">
            <div class="card-body">
                <img src="img/smk17.png" alt="Logo" class="logo">
                <h5 class="text-center mb-3 fw-semibold">Login Web Absensi</h5>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Username</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Masuk</button>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
