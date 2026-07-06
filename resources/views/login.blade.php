<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - IKM System</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            background: 
            linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.45)),
            url('https://images.unsplash.com/photo-1548550023-2bdb3c5beed7?q=80&w=1600&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: rgba(255,170,0,0.18);
            border-radius: 50%;
            top: -120px;
            left: -120px;
            filter: blur(40px);
        }

        body::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            bottom: -100px;
            right: -100px;
            filter: blur(40px);
        }

        .login-container {
            width: 420px;
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px); /* Fallback untuk Safari */
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 30px;
            padding: 45px;
            color: white;
            box-shadow: 0 15px 40px rgba(0,0,0,0.25);
            position: relative;
            z-index: 2;
        }

        .logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo img {
            width: 120px;
            margin-bottom: 12px;
        }

        .logo h1 {
            font-size: 34px;
        }

        .logo p {
            margin-top: 8px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
        }

        .input-group input {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 15px;
            background: rgba(255,255,255,.18);
            color: white;
            outline: none;
        }

        .input-group input::placeholder {
            color: #ddd;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 15px;
            background: #d97a00;
            color: white;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
        }

        .btn-login:hover {
            background: #b86400;
        }

        .error {
            background: #ffdddd;
            color: #b30000;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 15px;
            text-align: center;
        }

        .bottom-text {
            text-align: center;
            margin-top: 20px;
        }

        .back-home {
            position: absolute;
            top: 25px;
            left: 25px;
            text-decoration: none;
            color: white;
            background: rgba(255,255,255,0.15);
            padding: 12px 18px;
            border-radius: 30px;
            z-index: 10;
        }
    </style>
</head>
<body>

    <a href="{{ url('/') }}" class="back-home">
        ← Kembali
    </a>

    <div class="login-container">

        <div class="logo">
            <img src="{{ asset('img/pppp.png') }}" alt="Logo IKM">
            <h1>IKM System</h1>
            <p>Login Sistem Informasi IKM</p>
        </div>

        @if(session('error'))
            <div class="error">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf

            <div class="input-group">
                <label>Username</label>
                <input 
                    type="text" 
                    name="username" 
                    value="{{ old('username') }}" 
                    placeholder="Masukkan username" 
                    required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input 
                    type="password" 
                    name="password" 
                    placeholder="Masukkan password" 
                    required>
            </div>

            <button type="submit" class="btn-login">
                Login Sekarang
            </button>

        </form>

        <div class="bottom-text">
            &copy; {{ date('Y') }} IKM System. All Rights Reserved.
        </div>

    </div>

</body>
</html>