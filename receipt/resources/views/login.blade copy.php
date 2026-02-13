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

        .login-bg {
            text-align: center;
        }

        .login-bg-title{
            font-size: 20px;
            padding: 5px;
            color: #0d00ff;
        }

        .login-bg-subtitle{
            font-size: 17px;
            padding: 0 0 30px 0;
        }

        .login-container {
            background: white;
            padding: 40px;
            width: 350px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #0d00ff;
        }

        .login-input {
            margin-bottom: 20px;
        }

        .login-input label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            text-align: left;
        }

        .login-input select{
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            font-size: 15px;
        }

        .login-input select:focus {
            border-color: #667eea;
        }

        .login-input input{
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        .login-input input:focus {
            border-color: #667eea;
        }

        .login-btn {
            width: 100%;
            padding: 10px;
            background: #0d00ff;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-btn:hover {
            background: #3c47b1;
        }
    </style>
</head>
<body>
<div class="login-bg">
    <img src="images/icon.png">
    <div class="login-bg-title">
        <b>Provincial Treasury Office</b>
    </div>
    <div class="login-bg-subtitle">
        <p>Receipting System</p>
    </div>

<div class="login-container">
    <h2>Login</h2>

    <form method="POST" action="#">
        @csrf

        <div class="login-input">
            <label>Username</label>
            <select id="username" name="username">
                <option value="user">Alma</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="login-input">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" class="login-btn">Login</button>
    </form>
</div>

</div>
</body>
</html>
