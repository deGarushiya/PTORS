<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View reports</title>
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
         
        .search-container{
            width: 95%;
            max-width: 1400px;
            padding-top: 10px;
            padding-bottom: 10px;
            margin: auto;
        }

        .filters-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .filters-row label {
            font-weight: 600;
            margin-bottom: 0;
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

        .report-container{
            width: 95%;
            max-width: 1400px;
            max-height: calc(100vh - 260px);
            margin: auto;
            border: 3px solid #ddd;
            background-color: #ddd;
            border-radius: 5px;
            overflow: auto;
        }

        .report-table {
            border-collapse: collapse;
            width: 100%;
            min-width: 700px;
            font-size: 18px;
            margin-top: 5px !important;
            table-layout: fixed;
        }

        .report-table th,
        .report-table td {
            padding: 10px;
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

        .report-table .col-or-no { width: 120px; min-width: 120px; }
        .report-table .col-payor { width: 25%; min-width: 150px; }
        .report-table .col-amount { width: 130px; min-width: 130px; }
        .report-table .col-date { width: 110px; min-width: 110px; }
        .report-table .col-particulars { width: auto; min-width: 180px; }

        .pagination-container{
            width: 95%;
            max-width: 1400px;
            padding-top: 10px;
            padding-bottom: 10px;
            margin: auto;
        }

        .page-link{
            border: 1px solid #a0a0a0 !important;
            border-bottom: 3px solid #a0a0a0 !important;
            color: #7d7d7d !important;
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
                <a class="nav-link active" href="{{ route('report') }}">View reports</a>
            </li>
            @if(auth()->user()->isAdmin())
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin') }}">Admin</a>
            </li>
            @endif
            <li class="nav-item ms-auto" style="margin-right: 10px">
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-link nav-logout-btn">Log out</button>
                </form>
            </li>
        </ul>
    </nav>

    <form method="GET" action="{{ route('report') }}" class="search-container">
        @if(request('per_page'))
            <input type="hidden" name="per_page" value="{{ request('per_page') }}">
        @endif
        <div class="filters-row">
            <label for="filter-search">Search</label>
            <input type="text" id="filter-search" name="search" class="search" placeholder="OR No, Payor, Particulars..." value="{{ old('search', $search ?? '') }}">
            <label for="filter-date-from">Date from</label>
            <input type="date" id="filter-date-from" name="date_from" class="filter-input" value="{{ $dateFrom ?? '' }}">
            <label for="filter-date-to">Date to</label>
            <input type="date" id="filter-date-to" name="date_to" class="filter-input" value="{{ $dateTo ?? '' }}">
            <label for="filter-payment">Payment</label>
            <select id="filter-payment" name="payment_method" class="filter-input" style="min-width: 120px;">
                <option value="">All</option>
                <option value="Cash" {{ ($paymentMethod ?? '') == 'Cash' ? 'selected' : '' }}>Cash</option>
                <option value="Check" {{ ($paymentMethod ?? '') == 'Check' ? 'selected' : '' }}>Check</option>
                <option value="Money Order" {{ ($paymentMethod ?? '') == 'Money Order' ? 'selected' : '' }}>Money Order</option>
            </select>
            <button type="submit" class="btn btn-success">Apply</button>
            @if(!empty($search ?? '') || !empty($dateFrom ?? '') || !empty($dateTo ?? '') || !empty($paymentMethod ?? ''))
                <a href="{{ route('report', array_filter(request()->only('per_page'))) }}" class="btn btn-outline-secondary">Clear filters</a>
            @endif
        </div>
    </form>
    <div class="report-container">
        <table class="table table-hover report-table">
            <thead>
                <tr>
                    <th scope="col" class="col-or-no">OR No</th>
                    <th scope="col" class="col-payor">Payor</th>
                    <th scope="col" class="col-particulars">Particulars</th>
                    <th scope="col" class="col-amount" style="text-align: right;">Amount</th>
                    <th scope="col" class="col-date" style="width: 150px;">Date</th>
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
                    <td colspan="5" class="text-center py-4">No receipts yet. <a href="{{ route('user') }}">Create one</a>.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($receipts->hasPages())
    <div class="pagination-container">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>Showing {{ $receipts->firstItem() }}–{{ $receipts->lastItem() }} of {{ $receipts->total() }}</div>
            <div>{{ $receipts->links() }}</div>
        </div>
    </div>
    @endif

    <footer>
        <p class="mb-0 pt-2">Designed and Developed by Marzel Yna Carlet &amp; Gerard Garcia</p>
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
