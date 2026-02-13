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

        .table-container {
            width: 90%;
            margin: auto;
            margin-top: 50px;
            min-height: 500px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        table {
            width: 100%;
            font-size: 20px;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 1px 4px 8px 1px #1810aa;
            flex-grow: 1;
        }

        table tr, table th, table td {
            height: 20px; 
            vertical-align: middle;
        }

        thead{
            color: #1810aa;
        }

        #pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            gap: 5px; 
        }

        #pagination button {
            background-color: #1810aa;
            color: #fff;
            border-color: #1810aa;
        }

        #pagination button:disabled {
            background-color: #ccc;
            color: #666;
            border-color: #ccc;
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
                <a class="nav-link" href="{{ route('user') }}">Receipt</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('report') }}">Report</a>
            </li>
            <li class="nav-item ms-auto" style="margin-right: 10px">
                <a class="nav-link" href="{{ route('login') }}">Log out</a>
            </li>
        </ul>
    </nav>

    <h1>Users List</h1>

    <div class="table-container">
    <table>
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">OR no</th>
                <th scope="col">Payor</th>
                <th scope="col">Particulars</th>
                <th scope="col">Payment method</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <tr>
                <th scope="row">1</th>
                <td>12345</td>
                <td>Gerard Garcia</td>
                <td>Cash Advance</td>
                <td>Cash</td>
                <td>2/13/2026</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>54321</td>
                <td>Yna Carlet</td>
                <td>Cash Advance</td>
                <td>Cash</td>
                <td>2/13/2026</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>54321</td>
                <td>Yna Carlet</td>
                <td>Cash Advance</td>
                <td>Cash</td>
                <td>2/13/2026</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>54321</td>
                <td>Yna Carlet</td>
                <td>Cash Advance</td>
                <td>Cash</td>
                <td>2/13/2026</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>54321</td>
                <td>Yna Carlet</td>
                <td>Cash Advance</td>
                <td>Cash</td>
                <td>2/13/2026</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>54321</td>
                <td>Yna Carlet</td>
                <td>Cash Advance</td>
                <td>Cash</td>
                <td>2/13/2026</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>54321</td>
                <td>Yna Carlet</td>
                <td>Cash Advance</td>
                <td>Cash</td>
                <td>2/13/2026</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>54321</td>
                <td>Yna Carlet</td>
                <td>Cash Advance</td>
                <td>Cash</td>
                <td>2/13/2026</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>54321</td>
                <td>Yna Carlet</td>
                <td>Cash Advance</td>
                <td>Cash</td>
                <td>2/13/2026</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>54321</td>
                <td>Yna Carlet</td>
                <td>Cash Advance</td>
                <td>Cash</td>
                <td>2/13/2026</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>54321</td>
                <td>Yna Carlet</td>
                <td>Cash Advance</td>
                <td>Cash</td>
                <td>2/13/2026</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>54321</td>
                <td>Yna Carlet</td>
                <td>Cash Advance</td>
                <td>Cash</td>
                <td>2/13/2026</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>54321</td>
                <td>Yna Carlet</td>
                <td>Cash Advance</td>
                <td>Cash</td>
                <td>2/13/2026</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>54321</td>
                <td>Yna Carlet</td>
                <td>Cash Advance</td>
                <td>Cash</td>
                <td>2/13/2026</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>54321</td>
                <td>Yna Carlet</td>
                <td>Cash Advance</td>
                <td>Cash</td>
                <td>2/13/2026</td>
            </tr>
        </tbody>
    </table>
    </div>
    <div id="pagination" class="mt-3"></div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const rowsPerPage = 10; // 10 rows per page
        const table = document.querySelector("table");
        const tbody = table.querySelector("tbody");
        const rows = Array.from(tbody.querySelectorAll("tr"));
        const pagination = document.getElementById("pagination");

        const totalPages = Math.ceil(rows.length / rowsPerPage);
        let currentPage = 1;

        function displayPage(page) {
            // Validate page
            if (page < 1) page = 1;
            if (page > totalPages) page = totalPages;
            currentPage = page;

            // Show only rows for current page
            rows.forEach((row, index) => {
                row.style.display =
                    index >= (page - 1) * rowsPerPage &&
                    index < page * rowsPerPage
                        ? ""
                        : "none";
            });

            renderPagination();
        }

        function renderPagination() {
            pagination.innerHTML = "";

            // Previous button
            const prevBtn = document.createElement("button");
            prevBtn.textContent = "Prev";
            prevBtn.className = "btn btn-sm btn-outline-primary";
            prevBtn.disabled = currentPage === 1;
            prevBtn.style.marginRight = "5px";
            prevBtn.addEventListener("click", () => displayPage(currentPage - 1));
            pagination.appendChild(prevBtn);

            // Page input
            const input = document.createElement("input");
            input.type = "number";
            input.min = 1;
            input.max = totalPages;
            input.value = currentPage;
            input.style.width = "60px";
            input.style.margin = "0 5px";
            input.addEventListener("keydown", (e) => {
                if (e.key === "Enter") {
                    displayPage(parseInt(input.value));
                }
            });
            pagination.appendChild(input);

            // Total pages text
            const totalText = document.createElement("span");
            totalText.textContent = ` / ${totalPages}`;
            totalText.style.marginRight = "5px";
            pagination.appendChild(totalText);

            // Next button
            const nextBtn = document.createElement("button");
            nextBtn.textContent = "Next";
            nextBtn.className = "btn btn-sm btn-outline-primary";
            nextBtn.disabled = currentPage === totalPages;
            nextBtn.addEventListener("click", () => displayPage(currentPage + 1));
            pagination.appendChild(nextBtn);
        }

        displayPage(1);
    });
    </script>

    <footer>
        <p>@2026</p>
    </footer>
</body>
</html>
