<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            height: 100vh;
            background: #f3f3ff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: white;
            padding: 40px;
            width: 400px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
        }

        .login-title{
            font-size: 25px;
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

        .login-body{
            font-size: 25px;
            text-align: left;
            color: #0d0875;
            font-weight: bolder;
            font-family: "Lucida Console", "Courier New", monospace;
            margin-bottom: 5px;
        }

        .login-input {
            margin-bottom: 5px;
        }

        .login-input select{
            width: 100%;
            padding: 10px;
            border: 3px solid #ccc;
            border-radius: 5px;
            outline: none;
            font-size: 20px;
            margin-bottom: 10px;
            font-family: "Lucida Console", "Courier New", monospace;
        }

        .login-input select:focus {
            border-color: #0d0875;
        }

        .login-input input{
            width: 100%;
            padding: 10px;
            border: 3px solid #ccc;
            border-radius: 5px;
            outline: none;
            font-size: 20px;
            margin-bottom: 10px;
            font-family: "Lucida Console", "Courier New", monospace;
        }

        .login-input input:focus {
            border-color: #0d0875;
        }

        .login-btn {
            width: 100%;
            padding: 10px;
            background: #0d0875;
            border: none;
            color: white;
            font-size: 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            font-family: "Lucida Console", "Courier New", monospace;
        }

        .login-btn:hover {
            background: #1810aa;
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

    <!-- <div class="login-body">
        Log In
    </div> -->

    <form method="POST" action="#">
        @csrf
        <div class="login-input">
            <select id="username" name="username">
                <option value="user">Alma</option>
                <option value="admin">Admin</option>
            </select>
            <input placeholder="Password" type="password" name="password" required>
        </div>

        <button type="submit" class="login-btn">Log In</button>
    </form>
</div>
</body>
</html>
