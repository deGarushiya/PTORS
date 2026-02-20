<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/icon.png') }}" type="image/png">
    @php
        $bgImage = asset('images/PangasinanBanner_Capitol1.png');
    @endphp
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            height: 100vh;
            background-color: #e6eeff;
            background-image: url("{{ $bgImage }}");
            background-repeat: no-repeat;
            background-position: 13% 50%;
            background-attachment: fixed;
            background-size: 177%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: linear-gradient(to left, transparent 50%, rgba(230, 238, 255, 0.5) 75%, #e6eeff 100%);
            pointer-events: none;
            z-index: 0;
        }

        body > * {
            position: relative;
            z-index: 1;
        }

        .login-container {
            background: white;
            padding: 48px;
            width: 420px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
        }

        .login-hint {
            font-size: 18px;
            color: #333;
            margin-bottom: 24px;
        }

        .login-label {
            display: block;
            text-align: left;
            font-size: 18px;
            font-weight: bold;
            color: #0d0875;
            margin-bottom: 8px;
        }

        .login-error {
            color: #b71c1c;
            margin-bottom: 12px;
            font-size: 15px;
            font-weight: 500;
            background-color: #ffebee;
            border: 1px solid transparent;
            border-left: 4px solid #c62828;
            padding: 14px 18px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }

        .login-title{
            font-size: 26px;
            padding: 5px;
            color: #0d0875;
            font-weight: bolder;
            font-family: "Times New Roman", Times, serif;
        }

        .login-subtitle{
            font-size: 20px;
            padding: 0 0 50px 0;
            font-weight: bolder;
            font-family: "Times New Roman", Times, serif;
        }

        .login-input {
            margin-bottom: 5px;
        }

        .login-input select{
            width: 100%;
            padding: 14px;
            border: 3px solid #ccc;
            border-radius: 8px;
            outline: none;
            font-size: 20px;
            margin-bottom: 16px;
        }

        .login-input select:focus {
            border-color: #0d0875;
        }

        .login-input input{
            width: 100%;
            padding: 14px;
            border: 3px solid #ccc;
            border-radius: 8px;
            outline: none;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .login-input input:focus {
            border-color: #0d0875;
        }

        .login-btn {
            width: 100%;
            padding: 16px;
            background: #0d0875;
            border: none;
            color: white;
            font-size: 22px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 8px;
        }

        .login-btn:hover {
            background: #0a0660;
        }
    </style>
</head>
<body>

<div class="login-container">
    <img src="{{ asset('images/icon.png') }}" alt="Logo" style="width: 150px; height: 150px;">
    <div class="login-title">
        Provincial Treasury Office
    </div>
    <div class="login-subtitle">
        Receipting System
    </div>

    <p class="login-hint">Select your name and enter your password to open the system.</p>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        @if ($errors->has('username') || $errors->has('password'))
            <div class="login-error">{{ $errors->first('password') ?: $errors->first('username') }}</div>
        @endif
        <div class="login-input">
            <label for="username" class="login-label">User</label>
            <select id="username" name="username" required>
                <option value="">Select user...</option>
                <option value="test@example.com" {{ old('username') == 'test@example.com' ? 'selected' : '' }}>Alma (User)</option>
                <option value="admin@example.com" {{ old('username') == 'admin@example.com' ? 'selected' : '' }}>Admin</option>
            </select>
            <label for="password" class="login-label">Password</label>
            <input id="password" placeholder="Type your password here" type="password" name="password" required autocomplete="current-password">
        </div>

        <button type="submit" class="login-btn">Login</button>
    </form>
</div>
</body>
</html>
