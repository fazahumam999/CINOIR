<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - CINOIR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0D1323;
            color: #ffffff;
        }
        .login-box {
            max-width: 420px;
            margin: 80px auto;
            background-color: #1C2233;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.4);
        }
        .btn-login {
            background-color: #2C8AFF;
            border: none;
        }
        .btn-login:hover {
            background-color: #1f6fd1;
        }
        .form-label {
            color: #cfd4e0;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h3 class="text-center mb-4">Login ke <strong>CINOIR</strong></h3>
        
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Ingat Saya</label>
            </div>

            <button type="submit" class="btn btn-login w-100">Masuk</button>
        </form>
    </div>
</body>
</html>
