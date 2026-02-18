<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Page</title>
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
         
        .search-container{
            width: 80%;
            padding-top: 10px;
            padding-bottom: 10px;
            margin: auto;
        }

        .search{
            width: 300px;
            border: 3px solid #ddd;
            border-radius: 5px;
            padding: 5px;
        }

        .report-container{
            width: 80%;
            height: 500px;
            margin: auto;
            border: 3px solid #ddd;
            background-color: #ddd;
            border-radius: 5px;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            font-size: 18px;
        }

        th {
            border-bottom: 3px solid #ddd !important;
            padding: 10px;
            margin-top: 10px !important;
        }

        td {
            padding: 10px;
        }

        .pagination-container{
            width: 80%;
            padding-top: 10px;
            padding-bottom: 10px;
            margin: auto;
        }

        .page-link{
            border: 1px solid #a0a0a0 !important;
            border-bottom: 3px solid #a0a0a0 !important;
            color: #838282 !important;
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
    <nav>
        <ul class="nav nav-tabs">
            <div class>
                <img src="{{ asset('images/icon.png') }}" alt="Logo">
            </div>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user') }}">New receipt</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('report') }}">View reports</a>
            </li>
            <li class="nav-item ms-auto" style="margin-right: 10px">
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-link nav-logout-btn">Log out</button>
                </form>
            </li>
        </ul>
    </nav>

    <div class="search-container">
        <input type="text" class="search" placeholder="Search...">
    </div>
    <div class="report-container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" style="width: 100px">No</th>
                    <th scope="col" style="width: 100px">OR No</th>
                    <th scope="col">Payor</th>
                    <th scope="col">Particulars</th>
                    <th scope="col" style="width: 180px">Payment Method</th>
                    <th scope="col" style="width: 150px">Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">1</td>
                    <td>12345678</td>
                    <td>Vincent Aquino</td>
                    <td>Cash Advance</td>
                    <td>Money Order</td>
                    <td>02/18/2026</td>
                </tr>
                <tr>
                    <td scope="row">2</td>
                    <td>12345678</td>
                    <td>Vincent Aquino</td>
                    <td>Cash Advance</td>
                    <td>Money Order</td>
                    <td>02/18/2026</td>
                </tr>
                <tr>
                    <td scope="row">3</td>
                    <td>12345678</td>
                    <td>Vincent Aquino</td>
                    <td>Cash Advance</td>
                    <td>Money Order</td>
                    <td>02/18/2026</td>
                </tr>
                <tr>
                    <td scope="row">4</td>
                    <td>12345678</td>
                    <td>Vincent Aquino</td>
                    <td>Cash Advance</td>
                    <td>Money Order</td>
                    <td>02/18/2026</td>
                </tr>
                <tr>
                    <td scope="row">5</td>
                    <td>12345678</td>
                    <td>Vincent Aquino</td>
                    <td>Cash Advance</td>
                    <td>Money Order</td>
                    <td>02/18/2026</td>
                </tr>
                <tr>
                    <td scope="row">6</td>
                    <td>12345678</td>
                    <td>Vincent Aquino</td>
                    <td>Cash Advance</td>
                    <td>Money Order</td>
                    <td>02/18/2026</td>
                </tr>
                <tr>
                    <td scope="row">7</td>
                    <td>12345678</td>
                    <td>Vincent Aquino</td>
                    <td>Cash Advance</td>
                    <td>Money Order</td>
                    <td>02/18/2026</td>
                </tr>
                <tr>
                    <td scope="row">8</td>
                    <td>12345678</td>
                    <td>Vincent Aquino</td>
                    <td>Cash Advance</td>
                    <td>Money Order</td>
                    <td>02/18/2026</td>
                </tr>
                <tr>
                    <td scope="row">9</td>
                    <td>12345678</td>
                    <td>Vincent Aquino</td>
                    <td>Cash Advance</td>
                    <td>Money Order</td>
                    <td>02/18/2026</td>
                </tr>
                <tr>
                    <td scope="row">10</td>
                    <td>12345678</td>
                    <td>Vincent Aquino</td>
                    <td>Cash Advance</td>
                    <td>Money Order</td>
                    <td>02/18/2026</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        <ul class="pagination">
            <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
            </li>
        </ul>
    </div>

    <footer>
        <p>@2026</p>
    </footer>
</body>
</html>
