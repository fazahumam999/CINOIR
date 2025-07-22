<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Login - CINOIR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            height: 100vh;
            background-image: url('cinoirs.jpg'); /* Ganti dengan path yang sesuai */
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center; /* Posisi box login ke kanan agar tidak menutupi logo */
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #ffffff;
            padding-top: 290px;
        }

        .login-box {
        
            padding: 40px 50px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.7);
            width: 500px;
            text-align: center;
        }

        .login-box h3 {
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 30px;
            color: #d4af37; /* Emas */
            text-shadow: 0 0 10px rgba(212, 175, 55, 0.6);
        }

        .form-label {
            font-weight: 600;
            color: #e0e0e0;
            text-align: left;
            display: block;
            margin-bottom: 6px;
        }

        .form-control {
            background-color: #2c2f38;
            border: none;
            border-radius: 8px;
            color: #fff;
            padding: 12px 15px;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .form-control:focus {
            outline: none;
            box-shadow: 0 0 6px #d4af37;
            background-color: #3a3f4b;
        }

        .form-check-label {
            color: #ccc;
        }

        .btn-login {
            background: linear-gradient(135deg, #d4af37, #b58b2b);
            border: none;
            border-radius: 10px;
            padding: 12px 0;
            font-weight: 700;
            font-size: 1.1rem;
            width: 100%;
            color: #1b1b1b;
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.5);
            cursor: pointer;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #b58b2b, #d4af37);
            box-shadow: 0 6px 18px rgba(212, 175, 55, 0.8);
        }

        .alert {
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h3>Login</h3>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" class="form-control" required autofocus />

            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" class="form-control" required />

            <div class="form-check mb-3 text-start">
                <input id="remember" type="checkbox" name="remember" class="form-check-input" />
                <label for="remember" class="form-check-label">Ingat Saya</label>
            </div>

            <button type="submit" class="btn btn-login">Masuk</button>
        </form>
    </div>
</body>
</html>
