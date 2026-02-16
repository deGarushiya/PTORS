<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/icon.png') }}" type="image/png">
    <style>
        body {
    font-family: Inter, sans-serif;
    background: #f5f6fa;
}

.table-container {
    width: 95%;
    margin: 30px auto;
    background: white;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    padding: 20px;
}

.modern-table {
    width: 100%;
    border-collapse: collapse;
}

.modern-table thead {
    background: #f9fafb;
    text-align: left;
    font-weight: 600;
    font-size: 14px;
    color: #6b7280;
}

.modern-table th,
.modern-table td {
    padding: 14px 16px;
    border-bottom: 1px solid #eee;
}

.modern-table tbody tr:hover {
    background: #f9fafb;
}

/* Avatar */
.name-cell {
    display: flex;
    align-items: center;
    gap: 10px;
}

.avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
}

/* Badges */
.badge {
    padding: 4px 10px;
    font-size: 12px;
    border-radius: 20px;
    margin-right: 5px;
    font-weight: 500;
}

.purple { background: #ede9fe; color: #6d28d9; }
.pink   { background: #fce7f3; color: #be185d; }
.green  { background: #dcfce7; color: #15803d; }
.gray   { background: #f3f4f6; color: #6b7280; }

/* Footer */
.table-footer {
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Per Page Select */
.per-page-select {
    padding: 8px 12px;
    border-radius: 8px;
    border: 1px solid #ddd;
    background: white;
    cursor: pointer;
}

/* Pagination */
.pagination {
    display: flex;
    list-style: none;
    gap: 5px;
}

.pagination li a,
.pagination li span {
    padding: 8px 12px;
    border-radius: 6px;
    border: 1px solid #ddd;
    text-decoration: none;
    color: #374151;
}

.pagination li.active span {
    background: #6366f1;
    color: white;
    border-color: #6366f1;
}

.pagination li a:hover {
    background: #f3f4f6;
}

.report-nav {
    background: #0d0875;
    padding: 12px 20px;
    margin: -8px -8px 20px -8px;
    display: flex;
    align-items: center;
    gap: 20px;
}
.report-nav a, .report-nav .report-logout-btn {
    color: #fff;
    text-decoration: none;
    font-size: 18px;
    font-weight: bold;
}
.report-nav .report-logout-btn {
    background: none;
    border: none;
    cursor: pointer;
    margin-left: auto;
}
    </style>
</head>
<body>

<nav class="report-nav">
    <a href="{{ route('user') }}">← New receipt</a>
    <a href="{{ route('report') }}">View reports</a>
    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
        @csrf
        <button type="submit" class="report-logout-btn">Log out</button>
    </form>
</nav>

<div class="table-container">

    <table class="modern-table">
        <thead>
            <tr>
                <th>Name ↓</th>
                <th>Activity ↓</th>
                <th>Last Active ↓</th>
                <th>Location ↓</th>
                <th>Primary Email ↓</th>
                <th>Tags ↓</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="name-cell">
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <span class="badge purple">Badge</span>
                    <span class="badge pink">Badge</span>
                    <span class="badge green">Badge</span>
                    <span class="badge gray">+2</span>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Footer -->
    <div class="table-footer">

        <!-- Per Page Dropdown -->
        <form method="GET" class="per-page-form">
            <select name="per_page" onchange="this.form.submit()" class="per-page-select">
                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10 per page</option>
                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25 per page</option>
                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50 per page</option>
                <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100 per page</option>
            </select>
        </form>

        <!-- Showing Info -->
        <div class="pagination-info">
            @isset($receipts)
                Showing {{ $receipts->firstItem() ?? 0 }}–{{ $receipts->lastItem() ?? 0 }} of {{ $receipts->total() }}
            @else
                Showing 0 of 0
            @endisset
        </div>

        <!-- Pagination Links -->
        <div>
            @isset($receipts)
                {{ $receipts->links('pagination::default') }}
            @endif
        </div>

    </div>

</div>

</body>
</html>
