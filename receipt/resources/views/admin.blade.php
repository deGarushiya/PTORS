<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/icon.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding-top: 80px;  
            padding-bottom: 60px; 
            overflow-y: auto;
            font-family: "Lucida Console", "Courier New", monospace;
            background-image: linear-gradient(180deg, rgba(232,238,247,0.85) 0%, rgba(214,223,234,0.85) 50%, rgba(226,232,242,0.85) 100%), url("{{ asset('images/PangasinanBanner_Capitol2.png') }}");
            background-size: 100%, 140%;
            background-position: center, 8%;
            background-repeat: no-repeat, no-repeat;
            min-height: 100vh;
            position: relative;
        }

        body::after {
            content: '';
            position: fixed;
            right: -5%;
            bottom: -5%;
            width: 70%;
            max-width: 5000px;
            height: 70%;
            max-height: 5000px;
            /* /* background-image: url("{{ asset('images/icon.png') }}"); */ */
            /* background-size: contain;
            background-repeat: no-repeat;
            background-position: bottom right;
            opacity: 0.12;
            -webkit-mask-image: radial-gradient(ellipse 140% 140% at 0% 0%, transparent 25%, black 75%);
            mask-image: radial-gradient(ellipse 140% 140% at 0% 0%, transparent 25%, black 75%);
            -webkit-mask-size: 100% 100%;
            mask-size: 100% 100%;
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-position: top left;
            mask-position: top left;
            pointer-events: none; */
            z-index: 0;
        }

        .app-content-layer {
            position: relative;
            z-index: 1;
        }

        nav {
            list-style-type: none;
            margin: 0;
            padding: 15px 0 0 0;
            overflow: hidden;
            background-color: #0d0875;
            position: fixed;
            top: 0;
            width: 100%;
        }

        .nav img{
            font-size: 16px;
            color: #fff;
            font-weight: bolder;
            font-family: "Times New Roman", Times, serif;
            margin: 0 50px 0 50px;
            border: solid 1px #fff;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .nav a,
        .nav .nav-logout-btn {
            color: #fff;
            font-size: 20px;
            font-weight: bold;
            font-family: "Times New Roman", Times, serif;
        }

        .nav-logout-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px 12px;
        }

        .nav-link:hover{
            color: #fff;
        }

        .nav-item .logout{
            float: right !important;
        }

        .admin-container {
            max-width: 900px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .admin-title {
            font-size: 28px;
            font-weight: bold;
            color: #0d0875;
            margin-bottom: 24px;
        }

        .admin-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .admin-card {
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border-left: 4px solid #0d0875;
        }

        .admin-card-title {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 8px;
        }

        .admin-card-value {
            font-size: 24px;
            font-weight: bold;
            color: #0d0875;
        }

        .admin-links {
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .admin-links-title {
            font-size: 18px;
            font-weight: bold;
            color: #0d0875;
            margin-bottom: 16px;
        }

        .admin-links a {
            display: inline-block;
            padding: 12px 20px;
            margin-right: 12px;
            margin-bottom: 8px;
            background: #0d0875;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }

        .admin-links a:hover {
            background: #1810aa;
            color: #fff;
        }

        footer {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #fff;
            background-color: #0d0875;
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 15px;
            font-weight: bolder;
            font-family: "Times New Roman", Times, serif;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="app-content-layer">
    <nav>
        <ul class="nav nav-tabs">
            <div class>
                <img src="{{ asset('images/icon.png') }}" alt="Logo">
            </div>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user') }}">New receipt</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('report') }}">View reports</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin') }}">Admin</a>
            </li>
            <li class="nav-item ms-auto" style="margin-right: 10px">
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-link nav-logout-btn">Log out</button>
                </form>
            </li>
        </ul>
    </nav>

    <div class="admin-container">
        <h1 class="admin-title">Admin</h1>

        <div class="admin-cards">
            <div class="admin-card">
                <div class="admin-card-title">Total receipts</div>
                <div class="admin-card-value">{{ number_format($receiptsCount) }}</div>
            </div>
            <div class="admin-card">
                <div class="admin-card-title">Total amount</div>
                <div class="admin-card-value">₱ {{ number_format($receiptsTotal, 2, '.', ',') }}</div>
            </div>
            <div class="admin-card">
                <div class="admin-card-title">Active offices</div>
                <div class="admin-card-value">{{ $officesCount }}</div>
            </div>
        </div>

        <div class="admin-links">
            <div class="admin-links-title">Quick links</div>
            <a href="{{ route('user') }}">New receipt</a>
            <a href="{{ route('report') }}">View reports</a>
        </div>
    </div>

    <footer>
        <p>@2026</p>
    </footer>
    </div>
</body>
</html>
