<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <style>
        nav {
        list-style-type: none;
        margin: 0;
        padding: 15px 0 0 0;
        overflow: hidden;
        background-color: #1810aa;
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
            border-radius: 20px;
        }

        .nav a{
            color: #fff;
            font-size: 20px;
            font-weight: bold;
            font-family: "Times New Roman", Times, serif;
        }

        .nav-link:hover{
            color: #fff;
        }

        .nav-item .logout{
            float: right !important;
        }

        .container{
            border: solid 1px #000;
        }

        .receipt-container{
            margin-top: 100px;
        }

        footer {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            /* border-top: solid 3px #1810aa; */
            background-color: #fff;
            background-color: #1810aa;
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
                <img src="{{ asset('images/icon.png') }}" alt="Logo" style="width: 50px; height: 40px;">
            </div>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('user') }}">Receipt</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('report') }}">Report</a>
            </li>
            <li class="nav-item ms-auto" style="margin-right: 10px">
                <a class="nav-link" href="{{ route('login') }}">Log out</a>
            </li>
        </ul>
    </nav>

    <div class="receipt-container">
        <div class="container text-center">
            <div class="row row-cols-1">
                <div class="col">TITLE</div>
            </div>
        </div>
        <div class="container text-center">
            <div class="row row-cols-2">
                <div class="col">
                    Accountable Form No. 51
                    Revised January 1992
                </div>
                <div class="col">ORIGINAL</div>
                <div class="col">Date <input type="date" name="date"></div>
                <div class="col"><input placeholder="OR no" type="text" name="OR_no"></div>
            </div>
        </div>
        <div class="container text-center">
            <div class="row row-cols-2">
                <div class="col">
                    Agency
                </div>
                <div class="col">Fund</div>
            </div>
            <div class="row row-cols-1">
                <div class="col">Payor <input type="text" name="payor"></div>
            </div>
        </div>
        <div class="container text-center">
            <div class="row row-cols-1">
                <div class="col">Particulars 
                    <select id="particulars" name="particulars">
                        <option value="1">1</option>
                        <option value="1">2</option>
                    </select>
                </div>
            </div>
            <div class="row row-cols-3">
                <div class="col">Nature of Collection</div>
                <div class="col">Account Code</div>
                <div class="col">Amount</div>
            </div>
            <div class="row row-cols-1">
                <div class="col">Amount in words </div>
            </div>
        </div>
        <div class="container text-center">
            <div class="row row-cols-4">
                <div class="col">Check box</div>
                <div class="col">Bank name</div>
                <div class="col">Check number</div>
                <div class="col">Date</div>
            </div>
            <div class="row row-cols-1">
                <div class="col">Collecting Officer</div>
            </div>
        </div>
    </div>

    <footer>
        <p>@2026</p>
    </footer>
</body>
</html>
