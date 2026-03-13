<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View reports</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/icon.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <style>
        body {
            margin: 0;
            padding-top: 70px;
            padding-bottom: 56px;
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
            /* background-image: url("{{ asset('images/icon.png') }}"); */
            background-size: contain;
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
            pointer-events: none;
            z-index: 0;
        }

        .app-content-layer {
            position: relative;
            z-index: 1;
        }

        .modal { z-index: 1060 !important; }
        .modal-backdrop { z-index: 1055 !important; }

        nav {
            list-style-type: none;
            margin: 0;
            padding: 0 16px;
            overflow: hidden;
            background-color: #0d0875;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            display: flex;
            align-items: center;
            min-height: 56px;
            box-sizing: border-box;
        }

        nav .nav-brand {
            flex-shrink: 0;
            margin-right: 1.25rem;
        }

        nav .nav-brand img {
            display: block;
            border: solid 1px #fff;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        nav .nav-tabs {
            flex: 1;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            border: none;
            padding: 0;
            margin: 0;
            gap: 0;
        }

        nav .nav-item {
            display: flex;
            align-items: center;
        }

        nav .nav a,
        nav .nav .nav-logout-btn {
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            font-family: "Times New Roman", Times, serif;
        }

        nav .nav-link {
            padding: 10px 14px;
            display: inline-block;
        }

        nav .nav-link:hover {
            color: #fff;
        }

        nav .nav-link.active {
            background-color: rgba(255,255,255,0.2);
            border-radius: 4px;
        }

        .nav-logout-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 10px 14px;
        }

        .nav-item .logout {
            float: right !important;
        }

        .search-container {
            width: 95%;
            max-width: 1200px;
            padding: 16px 0;
            margin: 0 auto;
        }

        .filters-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px 16px;
            margin-bottom: 12px;
        }

        .filters-row label {
            font-weight: 600;
            margin-bottom: 0;
            white-space: nowrap;
        }

        .filters-row .btn {
            white-space: nowrap;
        }

        .search{
            width: 220px;
            border: 3px solid #ddd;
            border-radius: 5px;
            padding: 5px 8px;
        }

        .filter-input {
            border: 3px solid #ddd;
            border-radius: 5px;
            padding: 5px 8px;
        }

        .report-container {
            width: 95%;
            max-width: 1200px;
            max-height: calc(100vh - 240px);
            margin: 0 auto 20px;
            border: 2px solid #ccc;
            background-color: #fff;
            border-radius: 6px;
            overflow: auto;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        }

        .report-table {
            border-collapse: collapse;
            width: 100%;
            min-width: 520px;
            font-size: 15px;
            margin-top: 0 !important;
            table-layout: fixed;
        }

        .report-table th,
        .report-table td {
            padding: 8px 10px;
            overflow: hidden;
            text-overflow: ellipsis;
            border: 1px solid #999;
        }

        .report-table th {
            border-bottom: 2px solid #666;
            background-color: #e8e8e8;
        }

        .report-table tbody tr.report-row-clickable {
            cursor: pointer;
        }

        .report-table tbody tr:hover {
            background-color: #e0e0e0;
        }

        .report-table .col-or-no { width: 11%; min-width: 90px; }
        .report-table .col-payor { width: 20%; min-width: 100px; }
        .report-table .col-particulars { width: 39%; min-width: 120px; }
        .report-table .col-amount { width: 15%; min-width: 100px; }
        .report-table .col-date { width: 15%; min-width: 95px; }

        .pagination-container {
            width: 95%;
            max-width: 1200px;
            padding: 12px 0 20px;
            margin: 0 auto;
        }

        /* Hide duplicate "Showing X to Y of Z" from Bootstrap-5 template (we show it above) */
        .pagination-container .report-pagination-links nav p.small,
        .pagination-container .report-pagination-links nav .text-muted {
            display: none !important;
        }
        .pagination-container .report-pagination-links nav .d-none.d-sm-flex {
            display: flex !important;
        }
        .pagination-container .report-pagination-links nav .justify-content-sm-between {
            justify-content: flex-end !important;
        }
        .pagination-container .report-pagination-links nav,
        .pagination-container nav[aria-label="Pagination Navigation"],
        .pagination-container .pagination {
            display: flex !important;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 4px;
            margin: 0 !important;
            padding: 0 !important;
            list-style: none;
        }

        .pagination-container .page-item {
            display: inline-block;
        }

        .pagination-container .page-link {
            display: inline-block;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.4;
            border: 1px solid #a0a0a0 !important;
            border-radius: 4px;
            color: #333 !important;
            background: #fff;
            text-decoration: none;
        }

        .pagination-container .page-link:hover {
            background: #e9ecef;
        }

        .pagination-container .page-item.active .page-link {
            background: #0d0875;
            color: #fff !important;
            border-color: #0d0875 !important;
        }

        .pagination-container .page-item.disabled .page-link {
            opacity: 0.6;
            pointer-events: none;
        }

        .pagination-container .pagination svg,
        .pagination-container .page-link svg {
            width: 1em;
            height: 1em;
            vertical-align: middle;
        }

        footer {
            margin: 0;
            padding: 14px 16px;
            background-color: #0d0875;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            font-family: "Lucida Console", "Courier New", monospace;
            color: #fff;
            box-sizing: border-box;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="app-content-layer">
    <nav>
        <div class="nav-brand">
            <img src="{{ asset('images/icon.png') }}" alt="Logo">
        </div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user') }}">New receipt</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('report') }}">View reports</a>
            </li>
            @if(auth()->user()->isAdmin())
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin') }}">Admin</a>
            </li>
            @endif
            <li class="nav-item ms-auto">
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-link nav-logout-btn">Log out</button>
                </form>
            </li>
        </ul>
    </nav>

    <form method="GET" action="{{ route('report') }}" class="search-container">
        <div class="filters-row">
            <a href="{{ route('report', array_filter(array_merge(request()->only('search', 'payment_method'), ['date' => $prevDay]))) }}" class="btn btn-outline-secondary btn-sm" title="Previous day">&laquo; Prev day</a>
            <label for="filter-date">Date</label>
            <input type="date" id="filter-date" name="date" class="filter-input" value="{{ $date ?? '' }}">
            <a href="{{ route('report', array_filter(array_merge(request()->only('search', 'payment_method'), ['date' => $nextDay]))) }}" class="btn btn-outline-secondary btn-sm" title="Next day">Next day &raquo;</a>
            <label for="filter-search">Search</label>
            <input type="text" id="filter-search" name="search" class="search" placeholder="OR No, Payor, Particulars..." value="{{ old('search', $search ?? '') }}">
            <label for="filter-payment">Payment</label>
            <select id="filter-payment" name="payment_method" class="filter-input" style="min-width: 120px;">
                <option value="">All</option>
                <option value="Cash" {{ ($paymentMethod ?? '') == 'Cash' ? 'selected' : '' }}>Cash</option>
                <option value="Check" {{ ($paymentMethod ?? '') == 'Check' ? 'selected' : '' }}>Check</option>
                <option value="Money Order" {{ ($paymentMethod ?? '') == 'Money Order' ? 'selected' : '' }}>Money Order</option>
            </select>
            <button type="submit" class="btn btn-success">Apply</button>
            @if(!empty($search ?? '') || !empty($paymentMethod ?? ''))
                <a href="{{ route('report', ['date' => $date ?? '']) }}" class="btn btn-outline-secondary">Clear filters</a>
            @endif
        </div>
        <div class="text-muted small mb-2">Receipts for {{ $dateDisplay ?? $date ?? '—' }} ({{ $receipts->count() }})</div>
    </form>
    <div class="report-container">
        <table class="table table-hover report-table">
            <thead>
                <tr>
                    <th scope="col" class="col-or-no">OR No</th>
                    <th scope="col" class="col-payor">Payor</th>
                    <th scope="col" class="col-particulars">Particulars</th>
                    <th scope="col" class="col-amount" style="text-align: right;">Amount</th>
                    <th scope="col" class="col-date">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($receipts as $r)
                <tr class="report-row-clickable"
                    data-or="{{ e($r->receipt_number) }}"
                    data-payor="{{ e($r->payer_name) }}"
                    data-amount="P {{ number_format($r->amount, 2, '.', ',') }}"
                    data-date="{{ $r->receipt_date->format('m/d/Y') }}"
                    data-particulars="{{ e($r->description ?? '—') }}"
                    data-payment="{{ e($r->payment_method ?? '—') }}"
                    data-issued-by="{{ e($r->issuer->name ?? $r->issuer->email ?? '—') }}"
                    data-check-bank="{{ e($r->check_bank_name ?? '') }}"
                    data-check-number="{{ e($r->check_number ?? '') }}"
                    data-check-date="{{ $r->check_date ? $r->check_date->format('m/d/Y') : '' }}">
                    <td class="col-or-no">{{ $r->receipt_number }}</td>
                    <td class="col-payor">{{ $r->payer_name }}</td>
                    <td class="col-particulars">{{ $r->description ?? '—' }}</td>
                    <td class="col-amount" style="text-align: right;">P {{ number_format($r->amount, 2, '.', ',') }}</td>
                    <td class="col-date">{{ $r->receipt_date->format('m/d/Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">No receipts for this day. <a href="{{ route('user') }}">Create one</a> or choose another date.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <footer>
        <p>Designed and Developed by Marzel Yna Carlet &amp; Gerard Garcia</p>
    </footer>
    </div>

    <!-- Receipt details modal (outside content layer) -->
    <div class="modal fade" id="receiptDetailModal" tabindex="-1" aria-labelledby="receiptDetailModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #0d0875; color: #fff;">
                    <h5 class="modal-title" id="receiptDetailModalTitle">Receipt details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless mb-0" style="font-size: 18px;">
                        <tr><td class="text-muted fw-bold" style="width: 40%;">OR No</td><td id="detail-or"></td></tr>
                        <tr><td class="text-muted fw-bold">Payor</td><td id="detail-payor"></td></tr>
                        <tr><td class="text-muted fw-bold">Particulars</td><td id="detail-particulars"></td></tr>
                        <tr><td class="text-muted fw-bold">Payment method</td><td id="detail-payment"></td></tr>
                        <tr id="detail-check-row" style="display: none;">
                            <td class="text-muted fw-bold">Bank details</td>
                            <td id="detail-check-details"></td>
                        </tr>
                        <tr><td class="text-muted fw-bold">Amount</td><td id="detail-amount"></td></tr>
                        <tr><td class="text-muted fw-bold">Date</td><td id="detail-date"></td></tr>
                        <tr><td class="text-muted fw-bold">Issued by</td><td id="detail-issued-by"></td></tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = new bootstrap.Modal(document.getElementById('receiptDetailModal'));
        document.querySelectorAll('.report-row-clickable').forEach(function(row) {
            row.addEventListener('click', function() {
                document.getElementById('detail-or').textContent = this.getAttribute('data-or') || '—';
                document.getElementById('detail-payor').textContent = this.getAttribute('data-payor') || '—';
                document.getElementById('detail-amount').textContent = this.getAttribute('data-amount') || '—';
                document.getElementById('detail-date').textContent = this.getAttribute('data-date') || '—';
                document.getElementById('detail-particulars').textContent = this.getAttribute('data-particulars') || '—';
                document.getElementById('detail-payment').textContent = this.getAttribute('data-payment') || '—';
                document.getElementById('detail-issued-by').textContent = this.getAttribute('data-issued-by') || '—';
                var payment = this.getAttribute('data-payment') || '';
                var checkRow = document.getElementById('detail-check-row');
                var checkDetails = document.getElementById('detail-check-details');
                if (payment === 'Check') {
                    var bank = this.getAttribute('data-check-bank') || '—';
                    var num = this.getAttribute('data-check-number') || '—';
                    var date = this.getAttribute('data-check-date') || '—';
                    checkDetails.textContent = 'Bank: ' + bank + ' | Check no: ' + num + ' | Date: ' + date;
                    checkRow.style.display = '';
                } else {
                    checkRow.style.display = 'none';
                }
                modal.show();
            });
        });
    });
    </script>
</body>
</html>
