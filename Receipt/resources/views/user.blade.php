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
            color: #ffffff;
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

        .receipt-container{
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .container{
            margin-top: 3px;
            width: 50%;
            background-color: #f1f1f1;
        }

        .col{
            border: solid 1px #000;
        }

        .msg-popup-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .msg-popup-overlay.show { display: flex; }
        .msg-popup {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            max-width: 440px;
            width: 100%;
            overflow: hidden;
        }
        .msg-popup .msg-body {
            padding: 24px 24px 20px;
            font-size: 15px;
            font-weight: 500;
            line-height: 1.5;
        }
        .msg-popup .msg-footer {
            padding: 12px 24px 20px;
            text-align: right;
        }
        .msg-popup .msg-btn {
            padding: 10px 28px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            border: none;
            transition: opacity 0.2s;
        }
        .msg-popup .msg-btn:hover { opacity: 0.9; }
        .msg-popup.msg-success .msg-body { background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%); color: #1b5e20; }
        .msg-popup.msg-success .msg-btn { background: #2e7d32; color: #fff; }
        .msg-popup.msg-warning .msg-body { background: linear-gradient(135deg, #fff8e1 0%, #ffecb3 100%); color: #e65100; }
        .msg-popup.msg-warning .msg-btn { background: #f57c00; color: #fff; }
        .msg-popup.msg-danger .msg-body { background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%); color: #b71c1c; }
        .msg-popup.msg-danger .msg-btn { background: #c62828; color: #fff; }
        .msg-popup ul { padding-left: 1.2em; margin: 0; }

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
                <a class="nav-link active" href="{{ route('user') }}">New receipt</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('report') }}">View reports</a>
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

    <div id="msgPopupOverlay" class="msg-popup-overlay" role="dialog" aria-modal="true" aria-labelledby="msgPopupTitle">
        <div id="msgPopup" class="msg-popup" style="display: none;">
            <div class="msg-body" id="msgPopupBody"></div>
            <div class="msg-footer"><button type="button" class="msg-btn" id="msgPopupOk">OK</button></div>
        </div>
    </div>
    @php
        $msgType = null;
        $msgContent = '';
        if (session('error')) { $msgType = 'warning'; $msgContent = session('error'); }
        elseif (session('success')) { $msgType = 'success'; $msgContent = session('success'); }
        elseif ($errors->any()) { $msgType = 'danger'; $msgContent = '<ul>'.implode('', array_map(fn($e)=>'<li>'.e($e).'</li>', $errors->all())).'</ul>'; }
        elseif ($offices->isEmpty()) { $msgType = 'warning'; $msgContent = 'No office configured. Run php artisan db:seed to create the default office.'; }
    @endphp
    @if($msgType)
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        showMsgPopup({!! json_encode($msgType) !!}, {!! json_encode($msgContent) !!});
    });
    </script>
    @endif
    <script>
    function showMsgPopup(type, html) {
        var overlay = document.getElementById('msgPopupOverlay');
        var popup = document.getElementById('msgPopup');
        var body = document.getElementById('msgPopupBody');
        var btn = document.getElementById('msgPopupOk');
        if (!overlay || !popup || !body) return;
        popup.className = 'msg-popup msg-' + type;
        body.innerHTML = html;
        overlay.classList.add('show');
        popup.style.display = 'block';
        btn.onclick = function() {
            overlay.classList.remove('show');
            popup.style.display = 'none';
        };
        overlay.onclick = function(e) {
            if (e.target === overlay) btn.onclick();
        };
    }
    </script>
    @if(!$offices->isEmpty())
    <form method="POST" action="{{ route('receipts.store') }}" class="receipt-container">
        @csrf
        <input type="hidden" name="office_id" value="{{ $offices->first()->id }}">
        <div class="container text-center">
            <div class="row row-cols-4" style="border: solid 1px #000; padding-top: 20px;">
                <div class="col" style="border:none;">
                    <img src="{{ asset('images/republic.png') }}" alt="Logo" style="width: 100px; height: 100px;">
                </div>
                <div class="col" style="width: 350px; border:none;">
                    <h3 style="padding-top: 3px; font-weight: bold;">OFFICIAL RECEIPT</h3>
                    <p style="font-size: 13px;">
                    Republic of the Philippines
                    <br><b style="font-size: 15px;">OFFICE OF THE TREASURER</b>
                    <br>PROVINCE OF PANGASINAN
                    </p>
                </div>
                <div class="col" style="border:none;">
                    <img src="{{ asset('images/official.png') }}" alt="Logo" style="width: 105px; height: 105px;">
                </div>
            </div>
        </div>
        <div class="container text-center">
            <div class="row row-cols-2">
                <div class="col" style="padding: 10px; text-align: left;">
                    <b>Accountable Form No. 51</b>
                    <p>Revised January 1992</p>
                </div>
                <div class="col" style="font-weight: bold; padding-top: 30px;">ORIGINAL</div>
                <div class="col" style="padding: 10px; text-align: left;">DATE <input type="date" name="receipt_date" value="{{ old('receipt_date', date('Y-m-d')) }}" style="width: 100%;" required></div>
                <div class="col" style="padding: 10px;"><input placeholder="Official Receipt Number" type="text" name="receipt_number" value="{{ old('receipt_number') }}" style="width: 100%; height: 52px; text-align: center;" required maxlength="7" pattern="[0-9]{7}" title="Enter exactly 7 digits"></div>
            </div>
        </div>
        <div class="container text-center">
            <div class="row row-cols-2">
                <div class="col" style="padding: 10px; text-align: left;">
                    AGENCY
                </div>
                <div class="col" style="padding: 10px; text-align: left;">FUND</div>
            </div>
            <div class="row row-cols-1">
                <div class="col" style="padding: 10px; text-align: left;">Payor <input type="text" name="payer_name" value="{{ old('payer_name') }}" style="width: 100%;" required></div>
            </div>
        </div>
        <div class="container text-center">
            <div class="row row-cols-1">
                <div class="col" style="padding: 10px; text-align: left;">Particulars 
                    <select id="particulars" name="description" style="width: 50%; height: 30px;">
                        <option value="">— Select —</option>
                        <option value="Settlement of Cash Advance" {{ old('description') == 'Settlement of Cash Advance' ? 'selected' : '' }}>Settlement of Cash Advance</option>
                        <option value="Liquidation of Cash Advance" {{ old('description') == 'Liquidation of Cash Advance' ? 'selected' : '' }}>Liquidation of Cash Advance</option>
                        <option value="Remittance of Banaan Provincial Museum Shop Sale" {{ old('description') == 'Remittance of Banaan Provincial Museum Shop Sale' ? 'selected' : '' }}>Remittance of Banaan Provincial Museum Shop Sale</option>
                        <option value="Payment of 25% Government LGU Share" {{ old('description') == 'Payment of 25% Government LGU Share' ? 'selected' : '' }}>Payment of 25% Government LGU Share</option>
                        <option value="Refund of Unexpected Cash Advance" {{ old('description') == 'Refund of Unexpected Cash Advance' ? 'selected' : '' }}>Refund of Unexpected Cash Advance</option>
                        <option value="Maip" {{ old('description') == 'Maip' ? 'selected' : '' }}>Maip</option>
                    </select>
                </div>
            </div>
            <div class="row row-cols-3">
                <div class="col" style="text-align: center; font-weight: bold;">Nature of Collection</div>
                <div class="col" style="text-align: center; font-weight: bold;"></div>
                <div class="col" style="text-align: center; font-weight: bold;">Amount</div>
            </div>
            <div id="receiptNatureRows">
            <div class="row row-cols-3">
                <div class="col" style="text-align: left;"></div>
                <div class="col" style="text-align: left;"></div>
                <div class="col" style="text-align: right; padding: 10px;">P <input type="number" step="0.01" min="0" name="amount" id="receiptAmountInput" value="{{ old('amount') }}" style="width: 90%; text-align: right;" required></div>
            </div>
            </div>
            <div class="row row-cols-3">
                <div class="col" style="text-align: center;"><b>TOTAL</b></div>
                <div class="col" style="text-align: center;"></div>
                <div class="col" style="text-align: right; padding: 10px;"><b>P <span id="totalAmountDisplay">{{ old('amount') ? number_format((float)old('amount'), 2, '.', ',') : '0.00' }}</span></b></div>
            </div>
            <div class="row row-cols-1">
                <div class="col" style="padding: 10px; text-align: left;">Amount in words: <span id="amountInWordsDisplay"></span></div>
            </div>
        </div>
        <div class="container text-center">
            <div class="row row-cols-4" style="border:solid 1px #000;">
                <div class="col" style="border:none; text-align: left;">
                    <input type="radio" id="Cash" name="payment_method" value="Cash" {{ old('payment_method') == 'Cash' ? 'checked' : '' }}>
                    <label for="Cash"> Cash</label>
                </div>
                <div class="col">Bank name</div>
                <div class="col">Check number</div>
                <div class="col">Date</div>
                
                <div class="col" style="border:none; text-align: left;">
                    <input type="radio" id="Check" name="payment_method" value="Check" {{ old('payment_method') == 'Check' ? 'checked' : '' }}>
                    <label for="Check"> Check</label>
                </div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
                
                <div class="col" style="border:none; text-align: left;">
                    <input type="radio" id="MoneyOrder" name="payment_method" value="Money Order" {{ old('payment_method') == 'Money Order' ? 'checked' : '' }}>
                    <label for="MoneyOrder"> Money Order</label>
                </div>
                <div class="col" style="border:none;"></div>
                <div class="col"></div>
                <div class="col"></div>
            </div>
            <div class="row row-cols-2" style="border:solid 1px #000;">
                <div class="col" style="border:none">
                    <p style="font-size: 12px; text-align: left;">Received the amount stated above</p> 
                </div>
                <div class="col" style="border:none">
                    <h6>
                    <br> <b style="font-size: 18px;">ALMA CRUZ</b>
                    <br>______________________
                    <br> Collecting Officer
                    </h6>
                </div>
            </div>
        </div>
        <div class="container text-center" style="background-color: #ffffff00 !important;">
            <div class="row row-cols-1" style="background-color: #ffffff00 !important;">
                <div class="col" style="border:none">
                    <p style="font-size: 12px; text-align: left;">
                        NOTE: Write the number and date of this receipt on the back of check or money order received.
                    </p> 
                </div>
            </div>
        </div>
        <div class="container text-center" style="background-color: #ffffff00 !important;">
            <button type="submit" class="btn btn-primary me-2" style="min-width: 140px;">Save receipt</button>
            <button type="button" class="btn btn-secondary" style="min-width: 140px;" onclick="window.print();">Print</button>
        </div>
    </form>
    @endif

    <footer>
        <p>@2026</p>
    </footer>
    </div>

    <!-- Modal (outside content layer so it displays above backdrop) -->
<div class="modal fade" id="particularsModal" tabindex="-1" style="float: center;">
  <div class="modal-dialog" style="max-width: 1000px; overflow-y: auto;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalContent" style="font-weight: bold;"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body"  id="modalBodyContent">
            <!--  -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="particularsModalEnterBtn" data-bs-dismiss="modal">Enter</button>
      </div>
    </div>
  </div>
</div>

<!-- Script for different particulars-->
<script>
document.getElementById("particulars").addEventListener("change", function() {

    let value = this.value;
    let modalTitle = document.getElementById("modalContent");
    let modalBody = document.getElementById("modalBodyContent");

    if (!value) return;

    let content = "";

    switch(value) {

        case "Liquidation of Cash Advance":
            modalTitle.innerText = "Liquidation of Cash Advance";
            content = `
                <div class="row">
                    <div class="col-6">Amount</div>
                    <div class="col-6"><input type="text" class="form-control" id="liquidationAmountInput" placeholder="0.00"></div>
                </div>
            `;
        break;

        case "Settlement of Cash Advance":
            modalTitle.innerText = "Settlement of Cash Advance";
            content = `
                <div class="row row-cols-3" style="text-align: center; font-weight: bold;">
                    <div class="col">Nature of Collection</div>
                    <div class="col"></div>
                    <div class="col">Amount</div>
                </div>
                <div class="row row-cols-3">
                    <div class="col" style="padding: 10px;">Settlement of cash advance</div>
                    <div class="col"></div>
                    <div class="col" style="text-align: left; padding: 10px;">P <input type="text" id="settlementAmountInput" placeholder="0.00" style="width: 90%; text-align: right;"></div>
                </div>
                <div class="row row-cols-3">
                    <div class="col" style="padding: 10px; text-align: right;">Cash Advance</div>
                    <div class="col" style="padding: 10px;"><input type="text" id="cashAdvanceInput" placeholder="0.00" style="width: 100%; text-align: center;"></div>
                    <div class="col"></div>
                </div>
                <div class="row row-cols-3">
                    <div class="col" style="padding: 10px;">
                        <label>RCDs</label>
                        <input type="number" id="rcdCount" min="0" value="0"
                            style="width:20%; text-align:center;">
                        <button type="button" id="addRcdBtn">Add</button>
                        <button type="button" id="removeRcdBtn">Remove</button>
                    </div>
                    <div class="col"></div>
                    <div class="col"></div>
                </div>

                <div id="rcdContainer"></div>

                <div class="row row-cols-3">
                    <div class="col"></div>
                    <div class="col" style="padding: 10px; text-align: center;"><strong><span id="totalRcdDisplay">0.00</span></strong></div>
                    <div class="col"></div>
                </div>
                <div class="row row-cols-3">
                    <div class="col" style="padding: 10px; text-align: right;">Cash Refund</div>
                    <div class="col" id="cashRefundCell" style="padding: 10px; text-align: center;"><strong><span id="cashRefundDisplay">0.00</span></strong></div>
                    <div class="col"></div>
                </div>
                <div class="row row-cols-3">
                    <div class="col" style="padding: 10px;"><b>TOTAL</b></div>
                    <div class="col"></div>
                    <div class="col" style="text-align: left; padding: 10px;">P <input type="text" id="settlementTotalInput" placeholder="total" readonly style="width: 90%; text-align: right;"></div>
                </div>
            </div>
            `;
        break;

        case "Remittance of Banaan Provincial Museum Shop Sale":
            modalTitle.innerText = "Remittance of Banaan Provincial Museum Shop Sale";
            content = `
                <div class="row">
                    <div class="col-6">Total Sales</div>
                    <div class="col-6"><input type="text" class="form-control"></div>
                </div>
            `;
        break;

        case "Payment of 25% Government LGU Share":
            modalTitle.innerText = "Payment of 25% Government LGU Share";
            content = `
                <div class="row">
                    <div class="col-6">LGU Share</div>
                    <div class="col-6"><input type="text" class="form-control"></div>
                </div>
            `;
        break;

        case "Refund of Unexpected Cash Advance":
            modalTitle.innerText = "Refund of Unexpected Cash Advance";
            content = `
                <div class="row">
                    <div class="col-6">Refund Amount</div>
                    <div class="col-6"><input type="text" class="form-control"></div>
                </div>
            `;
        break;

        default:
            modalTitle.innerText = this.options[this.selectedIndex].text;
            content = `<p>No form available.</p>`;
    }

    modalBody.innerHTML = content;

    if (value === "Settlement of Cash Advance") {

        const rcdCountInput = document.getElementById("rcdCount");
        const rcdContainer = document.getElementById("rcdContainer");
        const addBtn = document.getElementById("addRcdBtn");
        const removeBtn = document.getElementById("removeRcdBtn");

        function generateRCDInputs(count) {
            rcdContainer.innerHTML = "";

            for (let i = 1; i <= count; i++) {
                rcdContainer.innerHTML += `
                    <div class="row row-cols-3" style="margin-bottom:5px;">
                        <div class="col" style="padding: 10px;">
                            <input type="number" step="0.01" min="0"
                                class="rcd-amount"
                                name="rcd[]"
                                placeholder="RCD ${i} amount"
                                style="width: 100%; text-align: center;">
                        </div>
                        <div class="col"></div>
                        <div class="col"></div>
                    </div>
                `;
            }
            updateTotalRcdDisplay();
        }

        function formatNumber(num) {
            const n = Number(num);
            if (isNaN(n)) return '0.00';
            const parts = n.toFixed(2).split('.');
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            return parts.join('.');
        }

        function updateTotalRcdDisplay() {
            const totalEl = document.getElementById("totalRcdDisplay");
            if (!totalEl) return;
            const inputs = rcdContainer.querySelectorAll("input.rcd-amount");
            let sum = 0;
            inputs.forEach(function(inp) {
                const v = parseFloat(inp.value);
                if (!isNaN(v)) sum += v;
            });
            totalEl.textContent = formatNumber(sum);
            updateCashRefundDisplay();
        }

        function updateCashRefundDisplay() {
            const cashRefundEl = document.getElementById("cashRefundDisplay");
            const cashAdvanceInput = document.getElementById("cashAdvanceInput");
            if (!cashRefundEl || !cashAdvanceInput) return;
            const cashAdvance = parseFloat(cashAdvanceInput.value.replace(/,/g, '')) || 0;
            const inputs = rcdContainer.querySelectorAll("input.rcd-amount");
            let totalRcd = 0;
            inputs.forEach(function(inp) {
                const v = parseFloat(inp.value);
                if (!isNaN(v)) totalRcd += v;
            });
            const cashRefund = cashAdvance - totalRcd;
            cashRefundEl.textContent = formatNumber(cashRefund);
            checkSettlementMatch();
        }

        function checkSettlementMatch() {
            const cashRefundEl = document.getElementById("cashRefundDisplay");
            const cashRefundCell = document.getElementById("cashRefundCell");
            const settlementAmountInput = document.getElementById("settlementAmountInput");
            const settlementTotalInput = document.getElementById("settlementTotalInput");
            if (!cashRefundEl || !cashRefundCell || !settlementAmountInput || !settlementTotalInput) return;
            const cashRefundNum = parseFloat(cashRefundEl.textContent.replace(/,/g, '')) || 0;
            const settlementNum = parseFloat(settlementAmountInput.value.replace(/,/g, ''));
            const hasSettlement = !isNaN(settlementNum);
            const matched = hasSettlement && Math.abs(cashRefundNum - settlementNum) < 0.005;
            if (!hasSettlement && cashRefundNum === 0) {
                cashRefundCell.style.border = '';
                settlementTotalInput.value = '';
                settlementTotalInput.style.color = '';
                settlementTotalInput.style.fontWeight = '';
            } else if (matched) {
                cashRefundCell.style.border = '2px solid #52b788';
                cashRefundCell.style.borderRadius = '4px';
                settlementTotalInput.value = formatNumber(cashRefundNum);
                settlementTotalInput.style.color = '';
                settlementTotalInput.style.fontWeight = 'normal';
            } else {
                cashRefundCell.style.border = '2px solid #dc3545';
                cashRefundCell.style.borderRadius = '4px';
                settlementTotalInput.value = 'Incorrect value';
                settlementTotalInput.style.color = '#dc3545';
                settlementTotalInput.style.fontWeight = 'bold';
            }
        }

        rcdContainer.addEventListener("input", function(e) {
            if (e.target.classList.contains("rcd-amount")) updateTotalRcdDisplay();
        });

        const cashAdvanceInputEl = document.getElementById("cashAdvanceInput");
        cashAdvanceInputEl.addEventListener("input", updateCashRefundDisplay);
        cashAdvanceInputEl.addEventListener("blur", function() {
            const n = parseFloat(this.value.replace(/,/g, ''));
            if (!isNaN(n) && n >= 0) this.value = formatNumber(n);
        });

        document.getElementById("settlementAmountInput").addEventListener("input", checkSettlementMatch);
        document.getElementById("settlementAmountInput").addEventListener("blur", function() {
            const n = parseFloat(this.value.replace(/,/g, ''));
            if (!isNaN(n) && n >= 0) this.value = formatNumber(n);
            checkSettlementMatch();
        });

        rcdCountInput.addEventListener("input", function () {
            generateRCDInputs(parseInt(this.value) || 0);
        });

        addBtn.addEventListener("click", function () {
            let current = parseInt(rcdCountInput.value) || 0;
            rcdCountInput.value = current + 1;
            generateRCDInputs(current + 1);
        });

        removeBtn.addEventListener("click", function () {
            let current = parseInt(rcdCountInput.value) || 0;
            if (current > 0) {
                rcdCountInput.value = current - 1;
                generateRCDInputs(current - 1);
            }
        });
    }

    let modal = new bootstrap.Modal(
        document.getElementById('particularsModal')
    );

    modal.show();

});
</script>

<!-- Populate receipt from particulars modal when Enter is clicked -->
<script>
document.getElementById('particularsModalEnterBtn').addEventListener('click', function() {
    var particulars = document.getElementById('particulars').value;
    if (particulars === 'Settlement of Cash Advance') {
        populateSettlementToReceipt();
    } else if (particulars === 'Liquidation of Cash Advance') {
        populateLiquidationToReceipt();
    }
});

function formatNumberReceipt(num) {
    var n = Number(num);
    if (isNaN(n)) return '0.00';
    var parts = n.toFixed(2).split('.');
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    return parts.join('.');
}

function populateSettlementToReceipt() {
    var settlementTotalInput = document.getElementById('settlementTotalInput');
    var cashAdvanceInput = document.getElementById('cashAdvanceInput');
    var cashRefundDisplay = document.getElementById('cashRefundDisplay');
    var rcdContainer = document.getElementById('rcdContainer');
    var receiptNatureRows = document.getElementById('receiptNatureRows');
    var totalAmountDisplay = document.getElementById('totalAmountDisplay');
    if (!settlementTotalInput || !receiptNatureRows) return;
    if (settlementTotalInput.value === 'Incorrect value') return;
    var totalNum = parseFloat(settlementTotalInput.value.replace(/,/g, '')) || 0;
    var cashAdvanceNum = parseFloat(cashAdvanceInput.value.replace(/,/g, '')) || 0;
    var rcdInputs = rcdContainer ? rcdContainer.querySelectorAll('input.rcd-amount') : [];
    var rows = '';
    rows += '<div class="row row-cols-3"><div class="col" style="padding: 10px; text-align: left;">Settlement of Cash Advance</div><div class="col" style="padding: 10px; text-align: left;"></div><div class="col" style="padding: 10px; text-align: right;">P <input type="number" step="0.01" min="0" name="amount" id="receiptAmountInput" value="' + totalNum + '" style="width: 90%; text-align: right;" required></div></div>';
    rows += '<div class="row row-cols-3"><div class="col" style="padding: 10px; text-align: left;">Cash Advance:</div><div class="col" style="padding: 10px; text-align: left;">' + formatNumberReceipt(cashAdvanceNum) + '</div><div class="col" style="text-align: right;"></div></div>';
    for (var i = 0; i < rcdInputs.length; i++) {
        var rcdVal = parseFloat(rcdInputs[i].value) || 0;
        rows += '<div class="row row-cols-3"><div class="col" style="padding: 10px; text-align: left;">RCD ' + (i + 1) + ': ' + formatNumberReceipt(rcdVal) + '</div><div class="col" style="text-align: left;"></div><div class="col" style="text-align: right;"></div></div>';
    }
    var rcdSum = 0;
    for (var j = 0; j < rcdInputs.length; j++) {
        rcdSum += parseFloat(rcdInputs[j].value) || 0;
    }
    var cashRefundNum = cashAdvanceNum - rcdSum;
    rows += '<div class="row row-cols-3"><div class="col" style="padding: 10px; text-align: left;">Total RCD:</div><div class="col" style="padding: 10px; text-align: left;">' + formatNumberReceipt(rcdSum) + '</div><div class="col" style="text-align: right;"></div></div>';
    rows += '<div class="row row-cols-3"><div class="col" style="padding: 10px; text-align: left;">Cash Refund:</div><div class="col" style="padding: 10px; text-align: left;">' + formatNumberReceipt(cashRefundNum) + '</div><div class="col" style="text-align: right;"></div></div>';
    receiptNatureRows.innerHTML = rows;
    if (totalAmountDisplay) totalAmountDisplay.textContent = formatNumberReceipt(totalNum);
    if (typeof updateAmountInWords === 'function') updateAmountInWords();
}

function populateLiquidationToReceipt() {
    var input = document.getElementById('liquidationAmountInput');
    var receiptNatureRows = document.getElementById('receiptNatureRows');
    var totalAmountDisplay = document.getElementById('totalAmountDisplay');
    if (!input || !receiptNatureRows) return;
    var amountNum = parseFloat(input.value.replace(/,/g, '')) || 0;
    var rows = '<div class="row row-cols-3"><div class="col" style="padding: 10px; text-align: left;">Liquidation of Cash Advance</div><div class="col" style="padding: 10px; text-align: left;"></div><div class="col" style="padding: 10px; text-align: right;">P <input type="number" step="0.01" min="0" name="amount" id="receiptAmountInput" value="' + amountNum + '" style="width: 90%; text-align: right;" required></div></div>';
    receiptNatureRows.innerHTML = rows;
    if (totalAmountDisplay) totalAmountDisplay.textContent = formatNumberReceipt(amountNum);
    if (typeof updateAmountInWords === 'function') updateAmountInWords();
}
</script>

<!-- Script for RCD (only runs when Settlement modal is open; main logic is in particulars change handler above) -->
<script>
// No global RCD init - elements exist only inside the Settlement modal after it's shown
</script>

<!-- Check Modal -->
<div class="modal fade" id="checkModal" tabindex="-1" aria-modal="true" aria-labelledby="checkModalTitle">
  <div class="modal-dialog" style="max-width: 900px; overflow-y: auto;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="checkModalTitle" style="font-weight: bold;">Check Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row row-cols-3">
            <div class="col">Drawee Bank</div>
            <div class="col">Number</div>
            <div class="col">Date</div>
        </div>
        <div class="row row-cols-3">
            <div class="col" style="padding: 10px;"><input type="text" style="width: 100%; text-align: center;"></div>
            <div class="col" style="padding: 10px;"><input type="text" style="width: 100%; text-align: center;"></div>
            <div class="col" style="padding: 10px;"><input type="text" style="width: 100%; text-align: center;"></div>
        </div>
      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Enter</button>
        </div>
    </div>
  </div>
</div>

<!-- Money Order Modal -->
<div class="modal fade" id="moneyOrderModal" tabindex="-1" aria-modal="true" aria-labelledby="moneyOrderModalTitle">
  <div class="modal-dialog" style="max-width: 900px; overflow-y: auto;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="moneyOrderModalTitle" style="font-weight: bold;">Money Order Information</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row row-cols-2">
            <div class="col">Number</div>
            <div class="col">Date</div>
        </div>
        <div class="row row-cols-2">
            <div class="col" style="padding: 10px;"><input type="text" style="width: 100%; text-align: center;"></div>
            <div class="col" style="padding: 10px;"><input type="text" style="width: 100%; text-align: center;"></div>
        </div>
      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Enter</button>
        </div>
    </div>
  </div>
</div>

<!-- Script for check and money order-->
<script>
    const checkboxes = document.querySelectorAll(
        '#Cash, #Check, #MoneyOrder'
    );

    checkboxes.forEach(box => {
        box.addEventListener('change', function () {

            // Uncheck others
            checkboxes.forEach(cb => {
                if (cb !== this) cb.checked = false;
            });

            if (this.checked) {
                if (this.id === "Check") {
                    const checkModal = new bootstrap.Modal(
                        document.getElementById('checkModal')
                    );
                    checkModal.show();
                }

                if (this.id === "MoneyOrder") {
                    const moneyModal = new bootstrap.Modal(
                        document.getElementById('moneyOrderModal')
                    );
                    moneyModal.show();
                }
            }
        });
    });
</script>
<script>
function numberToWords(num) {
    var n = parseFloat(num);
    if (isNaN(n) || n < 0) n = 0;
    n = Math.round(n * 100) / 100;
    var intPart = Math.floor(n);
    var decPart = Math.round((n - intPart) * 100);
    var ones = ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
    var tens = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
    function toWords(x) {
        if (x === 0) return 'zero';
        if (x < 20) return ones[x];
        if (x < 100) return tens[Math.floor(x / 10)] + (x % 10 ? ' ' + ones[x % 10] : '');
        if (x < 1000) return ones[Math.floor(x / 100)] + ' hundred' + (x % 100 ? ' ' + toWords(x % 100) : '');
        if (x < 1e6) return toWords(Math.floor(x / 1000)) + ' thousand' + (x % 1000 ? ' ' + toWords(x % 1000) : '');
        if (x < 1e9) return toWords(Math.floor(x / 1e6)) + ' million' + (x % 1e6 ? ' ' + toWords(x % 1e6) : '');
        return toWords(Math.floor(x / 1e9)) + ' billion' + (x % 1e9 ? ' ' + toWords(x % 1e9) : '');
    }
    var words = toWords(intPart);
    var centavos = (decPart < 10 ? '0' : '') + decPart;
    return words.replace(/^\w/, function(c) { return c.toUpperCase(); }) + ' and ' + centavos + '/100 pesos only';
}
function updateAmountInWords() {
    var el = document.getElementById('amountInWordsDisplay');
    if (!el) return;
    var totalEl = document.getElementById('totalAmountDisplay');
    var inputEl = document.getElementById('receiptAmountInput');
    var num = 0;
    if (inputEl && inputEl.value !== '') num = parseFloat(inputEl.value);
    else if (totalEl && totalEl.textContent) num = parseFloat(totalEl.textContent.replace(/,/g, ''));
    if (isNaN(num)) num = 0;
    el.textContent = numberToWords(num);
}
document.addEventListener('DOMContentLoaded', function() {
    function formatNumber(num) {
        var n = Number(num);
        if (isNaN(n)) return '0.00';
        var parts = n.toFixed(2).split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        return parts.join('.');
    }
    var totalDisplay = document.getElementById('totalAmountDisplay');
    var form = document.querySelector('form.receipt-container') || document.querySelector('form[action*="receipts.store"]');
    if (form && totalDisplay) {
        form.addEventListener('input', function(e) {
            if (e.target.name === 'amount') {
                var v = parseFloat(e.target.value);
                totalDisplay.textContent = formatNumber(v);
                updateAmountInWords();
            }
        });
    }
    updateAmountInWords();
});
</script>
</body>
</html>
