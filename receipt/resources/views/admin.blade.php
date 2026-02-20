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

        .active
        {
            background-color: #D8E1ED !important;
        }

        .nav-item .logout{
            float: right !important;
        }

        .admin-container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 24px;
        }

        .admin-header {
            margin-bottom: 28px;
            padding-bottom: 16px;
            border-bottom: 2px solid rgba(13, 8, 117, 0.2);
        }

        .admin-title {
            font-size: 28px;
            font-weight: bold;
            color: #0d0875;
            margin: 0 0 4px 0;
        }

        .admin-subtitle {
            font-size: 14px;
            color: #6b7280;
            margin: 0;
        }

        .admin-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 28px;
        }

        .admin-card {
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            border: 1px solid rgba(13, 8, 117, 0.1);
            transition: box-shadow 0.2s;
        }

        .admin-card:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        }

        .admin-card-title {
            font-size: 13px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .admin-card-value {
            font-size: 26px;
            font-weight: bold;
            color: #0d0875;
        }

        .admin-section {
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            border: 1px solid rgba(13, 8, 117, 0.1);
            margin-bottom: 24px;
        }

        .admin-section-title {
            font-size: 16px;
            font-weight: bold;
            color: #0d0875;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .admin-section-title::before {
            content: '';
            width: 4px;
            height: 20px;
            background: #0d0875;
            border-radius: 2px;
        }

        .admin-actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 12px;
        }

        .admin-actions-grid a {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 14px 20px;
            background: #0d0875;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            transition: background 0.2s;
        }

        .admin-actions-grid a:hover {
            background: #1810aa;
            color: #fff;
        }

        .admin-backup-inline {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 16px;
        }

        .admin-backup-inline p {
            margin: 0;
            font-size: 13px;
            color: #6b7280;
            max-width: 400px;
        }

        .admin-dev-gear {
            position: fixed;
            bottom: 70px;
            right: 24px;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #0d0875;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            text-decoration: none;
            transition: background 0.2s, transform 0.2s;
            z-index: 100;
        }
        .admin-dev-gear:hover {
            background: #1810aa;
            color: #fff;
            transform: scale(1.05);
        }
        .admin-dev-gear svg {
            width: 26px;
            height: 26px;
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
            font-family: "Lucida Console", "Courier New", monospace;
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
        <div class="admin-header">
            <h1 class="admin-title">Admin dashboard</h1>
            <p class="admin-subtitle">Overview and quick actions</p>
        </div>

        <div class="admin-stats">
            <div class="admin-card">
                <div class="admin-card-title">Total receipts</div>
                <div class="admin-card-value">{{ number_format($receiptsCount) }}</div>
            </div>
            <div class="admin-card">
                <div class="admin-card-title">Total amount</div>
                <div class="admin-card-value">₱ {{ number_format($receiptsTotal, 2, '.', ',') }}</div>
            </div>
        </div>

        <div class="admin-section">
            <div class="admin-section-title">Quick actions</div>
            <div class="admin-actions-grid">
                <a href="{{ route('user') }}">New receipt</a>
                <a href="{{ route('report') }}">View reports</a>
            </div>
        </div>

        <div class="admin-section">
            <div class="admin-section-title">Backup</div>
            @if(session('success'))
                <div class="alert alert-success mb-3">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger mb-3">{{ session('error') }}</div>
            @endif
            <div class="admin-backup-inline">
                <form method="POST" action="{{ route('admin.backup') }}">
                    @csrf
                    <button type="submit" class="btn btn-success">Run backup now</button>
                </form>
                <p>Backups are saved to the configured folder (e.g. Google Drive). A daily backup runs at 1:00 AM.</p>
            </div>
        </div>
    </div>

    <a href="{{ route('developer') }}" class="admin-dev-gear" title="Developer options" aria-label="Developer options">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 15.5A3.5 3.5 0 0 1 8.5 12 3.5 3.5 0 0 1 12 8.5a3.5 3.5 0 0 1 3.5 3.5 3.5 3.5 0 0 1-3.5 3.5m7.43-2.53c.04-.32.07-.65.07-1 0-.35-.03-.68-.07-1l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.3-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65A.488.488 0 0 0 12 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64L4.57 11c-.04.32-.07.65-.07 1 0 .35.03.68.07 1l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.23.09.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65z"/>
        </svg>
    </a>

    <footer>
        <p class="mb-0 pt-2">Designed and Developed by Marzel Yna Carlet &amp; Gerard Garcia</p>
    </footer>
    </div>
</body>
</html>
