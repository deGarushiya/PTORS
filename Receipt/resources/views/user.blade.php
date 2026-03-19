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
            padding-top: 70px;  
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

        body.embed-mode { padding-top: 0 !important; padding-bottom: 0 !important; }
        body.embed-mode nav, body.embed-mode footer { display: none !important; }
        body.embed-mode .receipt-container { margin-top: 0 !important; margin-bottom: 0 !important; }

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
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            flex-wrap: wrap;
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
        .msg-popup.msg-success .msg-btn-print { background: #0d6efd; color: #fff; }
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
            font-family: "Lucida Console", "Courier New", monospace;
            color: #fff;
        }

        @media print {
            body * { visibility: hidden; }
            #pdfReceiptModal, #pdfReceiptModal * { visibility: visible; }
            #pdfReceiptModal {
                position: fixed !important;
                inset: 0 !important;
                width: 100% !important;
                height: 100% !important;
                max-width: none !important;
                margin: 0 !important;
                padding: 0 !important;
                border: none !important;
                background: #fff !important;
                z-index: 99999 !important;
            }
            #pdfReceiptModal .modal-dialog { max-width: none !important; margin: 0 !important; height: 100% !important; }
            #pdfReceiptModal .modal-content { height: 100% !important; border: none !important; }
            #pdfReceiptModal .modal-header, #pdfReceiptModal .modal-footer { display: none !important; }
            #pdfReceiptModal .modal-body { height: 100% !important; padding: 0 !important; }
            #pdfReceiptModal .modal-backdrop { display: none !important; }
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
                <a class="nav-link active" href="{{ route('user') }}">New receipt</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('report') }}">View reports</a>
            </li>
            @if(auth()->user()->isAdmin())
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin') }}">Admin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('developer') }}">Developer</a>
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

    <div id="msgPopupOverlay" class="msg-popup-overlay" role="dialog" aria-modal="true" aria-labelledby="msgPopupTitle">
        <div id="msgPopup" class="msg-popup" style="display: none;">
            <div class="msg-body" id="msgPopupBody"></div>
            <div class="msg-footer" id="msgPopupFooter"></div>
        </div>
    </div>
    @php
        $msgType = null;
        $msgContent = '';
        $msgShowPrintReceipt = false;
        $savedReceiptId = session('saved_receipt_id');
        if (session('error')) { $msgType = 'warning'; $msgContent = session('error'); }
        elseif (session('success')) {
            $msgType = 'success';
            $msgContent = session('success');
            $msgShowPrintReceipt = !empty($savedReceiptId);
        }
        elseif ($errors->any()) { $msgType = 'danger'; $msgContent = '<ul>'.implode('', array_map(fn($e)=>'<li>'.e($e).'</li>', $errors->all())).'</ul>'; }
        elseif (!isset($office)) { $msgType = 'warning'; $msgContent = 'No office configured. Run php artisan db:seed to create the default office.'; }
    @endphp
    @if($msgType)
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var printReceiptUrl = {!! json_encode($savedReceiptId ? route('receipts.print', ['id' => $savedReceiptId]) : null) !!};
        showMsgPopup({!! json_encode($msgType) !!}, {!! json_encode($msgContent) !!}, printReceiptUrl);
    });
    </script>
    @endif
    <script>
    function showMsgPopup(type, html, printReceiptUrl) {
        var overlay = document.getElementById('msgPopupOverlay');
        var popup = document.getElementById('msgPopup');
        var body = document.getElementById('msgPopupBody');
        var footer = document.getElementById('msgPopupFooter');
        if (!overlay || !popup || !body || !footer) return;
        popup.className = 'msg-popup msg-' + type;
        body.innerHTML = html;
        overlay.classList.add('show');
        popup.style.display = 'block';
        function closePopup() {
            overlay.classList.remove('show');
            popup.style.display = 'none';
        }
        if (printReceiptUrl) {
            footer.innerHTML = '<button type="button" class="msg-btn msg-btn-print" id="msgPopupPrintReceipt">Print receipt</button><button type="button" class="msg-btn" id="msgPopupOk">OK</button>';
            document.getElementById('msgPopupPrintReceipt').onclick = function() {
                closePopup();
                var iframe = document.getElementById('pdfReceiptIframe');
                var modalEl = document.getElementById('pdfReceiptModal');
                if (iframe && modalEl) {
                    iframe.src = printReceiptUrl;
                    var modal = new bootstrap.Modal(modalEl);
                    modal.show();
                    document.getElementById('pdfReceiptDoneBtn').onclick = function() { modal.hide(); };
                }
            };
            document.getElementById('msgPopupOk').onclick = closePopup;
        } else {
            footer.innerHTML = '<button type="button" class="msg-btn" id="msgPopupOk">OK</button>';
            document.getElementById('msgPopupOk').onclick = closePopup;
        }
        overlay.onclick = function(e) {
            if (e.target === overlay) closePopup();
        };
    }
    </script>
    @if(isset($office))
    <form method="POST" action="{{ route('receipts.store') }}" class="receipt-container" id="receiptForm">
        @csrf
        <input type="hidden" name="office_id" value="{{ $office->id }}">
        <input type="hidden" name="nature_of_collection" id="natureOfCollectionInput" value="">
        <input type="hidden" name="check_bank_name" id="checkBankHidden" value="">
        <input type="hidden" name="check_number" id="checkNumberHidden" value="">
        <input type="hidden" name="check_date" id="checkDateHidden" value="">
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
                        @foreach($particulars ?? [] as $p)
                            <option value="{{ $p->name }}" data-modal-type="{{ $p->modal_type ?? '' }}" {{ old('description') == $p->name ? 'selected' : '' }}>{{ $p->name }}</option>
                        @endforeach
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
                <div class="col" style="text-align: left; padding: 10px;"></div>
                <div class="col" style="text-align: left; padding: 10px;"></div>
                <div class="col" style="text-align: left; padding: 10px;"></div>
            </div>
            </div>
            <div class="row row-cols-3">
                <div class="col" style="text-align: right; padding: 10px;"><b>TOTAL</b></div>
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
                    <input type="radio" id="Cash" name="payment_method" value="Cash" {{ old('payment_method', 'Cash') == 'Cash' ? 'checked' : '' }}>
                    <label for="Cash"> Cash</label>
                </div>
                <div class="col">Bank name</div>
                <div class="col">Check number</div>
                <div class="col">Date</div>
                
                <div class="col" style="border:none; text-align: left;">
                    <input type="radio" id="Check" name="payment_method" value="Check" {{ old('payment_method', 'Cash') == 'Check' ? 'checked' : '' }}>
                    <label for="Check"> Check</label>
                </div>
                <div class="col" id="receiptCheckBank" style="padding: 4px;"></div>
                <div class="col" id="receiptCheckNumber" style="padding: 4px;"></div>
                <div class="col" id="receiptCheckDate" style="padding: 4px;"></div>
                
                <div class="col" style="border:none; text-align: left;">
                    <input type="radio" id="MoneyOrder" name="payment_method" value="Money Order" {{ old('payment_method', 'Cash') == 'Money Order' ? 'checked' : '' }}>
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
        <div class="container text-center d-flex justify-content-between align-items-center flex-wrap gap-2" style="background-color: #ffffff00 !important;">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelledOrModal" style="min-width: 140px;">Record cancelled OR</button>
            <div class="d-flex gap-2 flex-wrap align-items-center">
                <button type="button" class="btn btn-outline-secondary btn-sm" id="fillSampleBtn" title="Fill form with sample data for testing">Fill sample</button>
                <button type="submit" class="btn btn-primary" style="min-width: 140px;">Save</button>
            </div>
        </div>
    </form>
    @endif

    <footer>
        <p class="mb-0 pt-2">Designed and Developed by Marzel Yna Carlet &amp; Gerard Garcia</p>
    </footer>
    </div>

    @if(isset($office))
    <!-- Record cancelled OR modal (outside content layer so it displays above backdrop) -->
    <div class="modal fade" id="cancelledOrModal" tabindex="-1" aria-modal="true" aria-labelledby="cancelledOrModalLabel">
  <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('receipts.storeCancelled') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="cancelledOrModalLabel">Record cancelled OR</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="cancelled_receipt_number" class="form-label">OR number <span class="text-danger">*</span></label>
                            <input type="text" name="receipt_number" id="cancelled_receipt_number" class="form-control" placeholder="7 digits" maxlength="7" pattern="[0-9]{7}" value="{{ old('receipt_number') }}" required>
                            @error('receipt_number')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="cancelled_receipt_date" class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" name="receipt_date" id="cancelled_receipt_date" class="form-control" value="{{ old('receipt_date', date('Y-m-d')) }}" required>
                        </div>
                        <input type="hidden" name="office_id" value="{{ $office->id }}">
                        <div class="mb-3">
                            <label for="cancelled_reason" class="form-label">Reason (optional)</label>
                            <textarea name="cancelled_reason" id="cancelled_reason" class="form-control" rows="2" placeholder="e.g. Spoiled, wrong amount...">{{ old('cancelled_reason') }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save cancelled OR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- PDF receipt modal: opens after Print, triggers browser print, then Done shows success -->
    <div class="modal fade" id="pdfReceiptModal" tabindex="-1" aria-labelledby="pdfReceiptModalLabel">
        <div class="modal-dialog modal-xl" style="max-width: 95%; height: 90vh;">
            <div class="modal-content" style="height: 90vh;">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfReceiptModalLabel">Official receipt</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0" style="height: calc(90vh - 120px); overflow: hidden;">
                    <iframe id="pdfReceiptIframe" style="width:100%; height:100%; border:none;" title="Receipt PDF"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="pdfReceiptDoneBtn">Done</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Particulars modal (outside content layer so it displays above backdrop) -->
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
        <button type="button" class="btn btn-success" id="particularsModalEnterBtn" data-bs-dismiss="modal">Enter</button>
      </div>
    </div>
  </div>
</div>

<!-- Script for different particulars-->
<script>
window.HOSPITALS = @json($hospitals ?? []);
window.ACCOUNT_CODES = @json($accountCodes ?? []);
window.HOSPITAL_TRUST_ACCOUNTS = @json($hospitalTrustAccounts ?? []);
window.HOSPITAL_GENERAL_ACCOUNTS = @json($hospitalGeneralAccounts ?? []);
document.getElementById("particulars").addEventListener("change", function() {

    let value = this.value;
    let modalTitle = document.getElementById("modalContent");
    let modalBody = document.getElementById("modalBodyContent");

    if (!value) return;

    if (window._fillSample) {
        window._fillSample = false;
        if (modalBody) {
            modalBody.innerHTML = '<div class="row"><div class="col-6">Amount</div><div class="col-6"><input type="text" class="form-control" id="simpleAmountInput" placeholder="0.00"></div></div>';
            var inp = document.getElementById('simpleAmountInput');
            if (inp) inp.value = '1500';
            if (typeof populateSimpleToReceipt === 'function') populateSimpleToReceipt();
        }
        return;
    }

    let modalType = (this.options[this.selectedIndex].dataset.modalType || '').toLowerCase();
    let mode = modalType;
    if (!mode && value === 'Settlement of Cash Advance') mode = 'settlement';
    if (!mode && value === 'Liquidation of Cash Advance') mode = 'liquidation';

    let content = "";

    if (mode === 'settlement') {
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
    } else if (mode === 'trust') {
            // Trust Fund modal: from hospital_trust_accounts table
            var trustList = window.HOSPITAL_TRUST_ACCOUNTS || [];
            var trustPairOpts = trustList.map(function(h) { var n = String(h.name || '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;'); var c = String(h.account_code || '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;'); return '<option value="'+n+'|||'+c+'">'+n+(c ? ' — '+c : '')+'</option>'; }).join('');
            modalTitle.innerText = value;
            content = '<div class="row"><div class="col-9">To withdraw the amount from Drugs and Medication account, LBP Lingayen CA# <select id="trustHospitalAccountSelect" class="form-select form-select-sm" style="min-width:220px;display:inline-block;"><option value="">— Select Hospital —</option>'+trustPairOpts+'</select>, to be deposited to LBP Lingayen CA# 2422-1042-51 Trust Fund (4)-Common Fund</div><div class="col-3"><input type="text" class="form-control" id="simpleAmountInput" placeholder="0.00"></div></div>';
    } else if (mode === 'general') {
            // General Fund modal: from hospital_general_accounts (hospital name + account_code)
            var currentYear = new Date().getFullYear();
            var generalList = window.HOSPITAL_GENERAL_ACCOUNTS || [];
            var genPairOpts = generalList.map(function(h) { var n = String(h.name || '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;'); var c = String(h.account_code || '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;'); return '<option value="'+n+'|||'+c+'">'+n+(c ? ' — '+c : '')+'</option>'; }).join('');
            modalTitle.innerText = value;
            content = '<div class="row"><div class="col-9">To withdraw the amount from General Fund <select id="generalHospitalAccountSelect" class="form-select form-select-sm" style="min-width:220px;display:inline-block;"><option value="">— Select Hospital —</option>'+genPairOpts+'</select> for deposit to General Fund LBP Lingayen Account No. 2422-1000-51 representing income earned for the <select id="generalQuarterSelect" class="form-select form-select-sm" style="width:auto;display:inline-block;"><option value="1st">1st</option><option value="2nd">2nd</option><option value="3rd">3rd</option><option value="4th">4th</option></select> Quarter <input type="number" id="generalYearInput" min="2020" max="2035" value="'+currentYear+'" style="width:5em;display:inline-block;text-align:center;" title="Year"></div><div class="col-3"><input type="text" class="form-control" id="simpleAmountInput" placeholder="0.00"></div></div>';
    } else if (mode === 'liquidation') {
            modalTitle.innerText = "Liquidation of Cash Advance";
            content = `
                <div class="row row-cols-3" style="text-align: center; font-weight: bold;">
                    <div class="col">Nature of Collection</div>
                    <div class="col"></div>
                    <div class="col">Amount</div>
                </div>
                <div class="row row-cols-3">
                    <div class="col" style="padding: 10px;">Liquidation of cash advance</div>
                    <div class="col"></div>
                    <div class="col" style="text-align: left; padding: 10px;">P <input type="text" id="liquidationAmountInput" placeholder="0.00" style="width: 90%; text-align: right;"></div>
                </div>
                <div class="row row-cols-3">
                    <div class="col" style="padding: 10px;">
                        <label>Descriptions</label>
                        <input type="number" id="desCount" min="0" value="0"
                            style="width:15%; text-align:center;">
                        <button type="button" id="addDesBtn">Add</button>
                        <button type="button" id="removeDesBtn">Remove</button>
                    </div>
                    <div class="col"></div>
                    <div class="col"></div>
                </div>

                <div id="desContainer"></div>

                <div class="row row-cols-3">
                    <div class="col" style="padding: 10px; text-align: right;">Cash Advance</div>
                    <div class="col" style="padding: 10px;"><input type="text" id="cashAdvanceInput" placeholder="0.00" style="width: 100%; text-align: center;"></div>
                    <div class="col"></div>
                </div>
                <div class="row row-cols-3">
                    <div class="col" style="padding: 10px; text-align: right;">Total amount spend</div>
                    <div class="col" style="padding: 10px;"><input type="text" id="totalSpendInput" placeholder="0.00" style="width: 100%; text-align: center;"></div>
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
                    <div class="col" style="text-align: left; padding: 10px;">P <input type="text" id="liquidationTotalInput" placeholder="total" readonly style="width: 90%; text-align: right;"></div>
                </div>
            </div>
            `;
    } else {
            // Simple (amount only) – modal_type empty/simple or any option with amount-only modal
            modalTitle.innerText = value;
            content = `
                <div class="row">
                    <div class="col-6">Amount</div>
                    <div class="col-6"><input type="text" class="form-control" id="simpleAmountInput" placeholder="0.00"></div>
                </div>
            `;
    }

    modalBody.innerHTML = content;

    if (mode === 'settlement') {

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

    if (mode === 'liquidation') {

        const desCountInput = document.getElementById("desCount");
        const desContainer = document.getElementById("desContainer");
        const addBtn = document.getElementById("addDesBtn");
        const removeBtn = document.getElementById("removeDesBtn");

        function generateDESInputs(count) {
            desContainer.innerHTML = "";

            for (let i = 1; i <= count; i++) {
                desContainer.innerHTML += `
                    <div class="row row-cols-3" style="margin-bottom:5px;">
                        <div class="col" style="padding: 10px;">
                            <input type="text"
                                class="des-amount"
                                name="des[]"
                                placeholder="Description ${i}"
                                style="width: 100%; text-align: center;">
                        </div>
                        <div class="col"></div>
                        <div class="col"></div>
                    </div>
                    
                `;
            }
            updateTotalDesDisplay();
        }

        function formatNumber(num) {
            const n = Number(num);
            if (isNaN(n)) return '0.00';
            const parts = n.toFixed(2).split('.');
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            return parts.join('.');
        }

        function updateTotalDesDisplay() {
            updateCashRefundDisplay();
        }

        function updateCashRefundDisplay() {
            const cashRefundEl = document.getElementById("cashRefundDisplay");
            const cashAdvanceInput = document.getElementById("cashAdvanceInput");
            const totalSpendInput = document.getElementById("totalSpendInput");
            if (!cashRefundEl || !cashAdvanceInput || !totalSpendInput) return;
            const cashAdvance = parseFloat(cashAdvanceInput.value.replace(/,/g, '')) || 0;
            const totalSpend = parseFloat(totalSpendInput.value.replace(/,/g, '')) || 0;
            const cashRefund = cashAdvance - totalSpend;
            cashRefundEl.textContent = formatNumber(cashRefund);
            checkLiquidationMatch();
        }

        function checkLiquidationMatch() {
            const cashRefundEl = document.getElementById("cashRefundDisplay");
            const cashRefundCell = document.getElementById("cashRefundCell");
            const liquidationAmountInput = document.getElementById("liquidationAmountInput");
            const liquidationTotalInput = document.getElementById("liquidationTotalInput");
            if (!cashRefundEl || !cashRefundCell || !liquidationAmountInput || !liquidationTotalInput) return;
            const cashRefundNum = parseFloat(cashRefundEl.textContent.replace(/,/g, '')) || 0;
            const liquidationNum = parseFloat(liquidationAmountInput.value.replace(/,/g, ''));
            const hasLiquidation = !isNaN(liquidationNum);
            const matched = hasLiquidation && Math.abs(cashRefundNum - liquidationNum) < 0.005;
            if (!hasLiquidation && cashRefundNum === 0) {
                cashRefundCell.style.border = '';
                liquidationTotalInput.value = '';
                liquidationTotalInput.style.color = '';
                liquidationTotalInput.style.fontWeight = '';
            } else if (matched) {
                cashRefundCell.style.border = '2px solid #52b788';
                cashRefundCell.style.borderRadius = '4px';
                liquidationTotalInput.value = formatNumber(cashRefundNum);
                liquidationTotalInput.style.color = '';
                liquidationTotalInput.style.fontWeight = 'normal';
            } else {
                cashRefundCell.style.border = '2px solid #dc3545';
                cashRefundCell.style.borderRadius = '4px';
                liquidationTotalInput.value = 'Incorrect value';
                liquidationTotalInput.style.color = '#dc3545';
                liquidationTotalInput.style.fontWeight = 'bold';
            }
        }

        desContainer.addEventListener("input", function(e) {
            if (e.target.classList.contains("des-amount")) updateTotalDesDisplay();
        });

        const cashAdvanceInputEl = document.getElementById("cashAdvanceInput");
        cashAdvanceInputEl.addEventListener("input", updateCashRefundDisplay);
        cashAdvanceInputEl.addEventListener("blur", function() {
            const n = parseFloat(this.value.replace(/,/g, ''));
            if (!isNaN(n) && n >= 0) this.value = formatNumber(n);
            updateCashRefundDisplay();
        });
        const totalSpendInputEl = document.getElementById("totalSpendInput");
        if (totalSpendInputEl) {
            totalSpendInputEl.addEventListener("input", updateCashRefundDisplay);
            totalSpendInputEl.addEventListener("blur", function() {
                const n = parseFloat(this.value.replace(/,/g, ''));
                if (!isNaN(n) && n >= 0) this.value = formatNumber(n);
                updateCashRefundDisplay();
            });
        }

        document.getElementById("liquidationAmountInput").addEventListener("input", checkLiquidationMatch);
        document.getElementById("liquidationAmountInput").addEventListener("blur", function() {
            const n = parseFloat(this.value.replace(/,/g, ''));
            if (!isNaN(n) && n >= 0) this.value = formatNumber(n);
            checkLiquidationMatch();
        });

        desCountInput.addEventListener("input", function () {
            generateDESInputs(parseInt(this.value) || 0);
        });

        addBtn.addEventListener("click", function () {
            let current = parseInt(desCountInput.value) || 0;
            desCountInput.value = current + 1;
            generateDESInputs(current + 1);
        });

        removeBtn.addEventListener("click", function () {
            let current = parseInt(desCountInput.value) || 0;
            if (current > 0) {
                desCountInput.value = current - 1;
                generateDESInputs(current - 1);
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
(function() {
    function attachEnterHandler() {
        var btn = document.getElementById('particularsModalEnterBtn');
        var receiptNatureRows = document.getElementById('receiptNatureRows');
        if (!btn || !receiptNatureRows) return false;
        btn.addEventListener('click', function() {
            var sel = document.getElementById('particulars');
            if (!sel) return;
            var particulars = (sel.value || '').trim();
            var modalType = (sel.options[sel.selectedIndex] && sel.options[sel.selectedIndex].dataset ? (sel.options[sel.selectedIndex].dataset.modalType || '') : '').toLowerCase();
            var amountFromModal = '';
            var simpleInput = document.getElementById('simpleAmountInput');
            if (simpleInput) amountFromModal = (simpleInput.value || '').trim();
            var trustPairSel = document.getElementById('trustHospitalAccountSelect');
            var trustAccount = ''; var trustHosp = '';
            if (trustPairSel && trustPairSel.value) { var p = trustPairSel.value.split('|||'); trustHosp = p[0] || ''; trustAccount = p[1] || ''; }
            var genPairSel = document.getElementById('generalHospitalAccountSelect');
            var genHospital = ''; var genAccount = '';
            if (genPairSel && genPairSel.value) { var q = genPairSel.value.split('|||'); genHospital = q[0] || ''; genAccount = q[1] || ''; }
            var genQuarterSel = document.getElementById('generalQuarterSelect');
            var genYearInput = document.getElementById('generalYearInput');
            var genQuarterStr = (genQuarterSel && genYearInput) ? (genQuarterSel.value || '') + ' Quarter ' + (genYearInput.value || '') : '';
            if (modalType === 'settlement' || particulars === 'Settlement of Cash Advance') {
                if (typeof populateSettlementToReceipt === 'function') populateSettlementToReceipt();
            } else if (modalType === 'liquidation' || particulars === 'Liquidation of Cash Advance') {
                if (typeof populateLiquidationToReceipt === 'function') populateLiquidationToReceipt();
            } else if (modalType === 'trust') {
                if (typeof populateTrustToReceipt === 'function') populateTrustToReceipt(particulars, amountFromModal, trustAccount, trustHosp);
            } else if (modalType === 'general') {
                if (typeof populateGeneralToReceipt === 'function') populateGeneralToReceipt(particulars, amountFromModal, genHospital, genAccount, genQuarterStr);
            } else {
                if (typeof populateSimpleToReceipt === 'function') populateSimpleToReceipt(particulars, amountFromModal);
            }
        });
        return true;
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', attachEnterHandler);
    } else {
        attachEnterHandler();
    }
})();

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
    var liquidationTotalInput = document.getElementById('liquidationTotalInput');
    var liquidationAmountInput = document.getElementById('liquidationAmountInput');
    var cashAdvanceInput = document.getElementById('cashAdvanceInput');
    var totalSpendInput = document.getElementById('totalSpendInput');
    var cashRefundDisplay = document.getElementById('cashRefundDisplay');
    var desContainer = document.getElementById('desContainer');
    var receiptNatureRows = document.getElementById('receiptNatureRows');
    var totalAmountDisplay = document.getElementById('totalAmountDisplay');
    if (!receiptNatureRows) return;
    var totalNum = 0;
    if (liquidationTotalInput && liquidationTotalInput.value && liquidationTotalInput.value !== 'Incorrect value') {
        totalNum = parseFloat(liquidationTotalInput.value.replace(/,/g, '')) || 0;
    } else if (liquidationAmountInput) {
        totalNum = parseFloat(liquidationAmountInput.value.replace(/,/g, '')) || 0;
    }
    var cashAdvanceNum = cashAdvanceInput ? parseFloat(cashAdvanceInput.value.replace(/,/g, '')) || 0 : 0;
    var totalSpendNum = totalSpendInput ? parseFloat(totalSpendInput.value.replace(/,/g, '')) || 0 : 0;
    var cashRefundNum = cashRefundDisplay ? parseFloat(cashRefundDisplay.textContent.replace(/,/g, '')) || 0 : 0;
    var rows = '';
    rows += '<div class="row row-cols-3"><div class="col" style="padding: 10px; text-align: left;">Liquidation of Cash Advance</div><div class="col" style="padding: 10px; text-align: left;"></div><div class="col" style="padding: 10px; text-align: right;">P <input type="number" step="0.01" min="0" name="amount" id="receiptAmountInput" value="' + totalNum + '" style="width: 90%; text-align: right;" required></div></div>';
    rows += '<div class="row row-cols-3"><div class="col" style="padding: 10px; text-align: left;">Cash Advance:</div><div class="col" style="padding: 10px; text-align: left;">' + formatNumberReceipt(cashAdvanceNum) + '</div><div class="col" style="text-align: right;"></div></div>';
    var desInputs = desContainer ? desContainer.querySelectorAll('input.des-amount') : [];
    for (var i = 0; i < desInputs.length; i++) {
        var desc = (desInputs[i].value || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        if (desc) rows += '<div class="row row-cols-3"><div class="col" style="padding: 10px; text-align: left;">' + desc + '</div><div class="col"></div><div class="col"></div></div>';
    }
    rows += '<div class="row row-cols-3"><div class="col" style="padding: 10px; text-align: left;">Total amount spend:</div><div class="col" style="padding: 10px; text-align: left;">' + formatNumberReceipt(totalSpendNum) + '</div><div class="col" style="text-align: right;"></div></div>';
    rows += '<div class="row row-cols-3"><div class="col" style="padding: 10px; text-align: left;">Cash Refund:</div><div class="col" style="padding: 10px; text-align: left;">' + formatNumberReceipt(cashRefundNum) + '</div><div class="col" style="text-align: right;"></div></div>';
    receiptNatureRows.innerHTML = rows;
    if (totalAmountDisplay) totalAmountDisplay.textContent = formatNumberReceipt(totalNum);
    if (typeof updateAmountInWords === 'function') updateAmountInWords();
}

function populateTrustToReceipt(particularName, amountStr, accountCode, hospital) {
    var receiptNatureRows = document.getElementById('receiptNatureRows');
    var totalAmountDisplay = document.getElementById('totalAmountDisplay');
    if (!receiptNatureRows) return;
    var amountNum = parseFloat(String(amountStr || '').replace(/,/g, '')) || 0;
    var safe = function(s) { return String(s || '').replace(/</g, '&lt;').replace(/>/g, '&gt;').trim(); };
    var ac = safe(accountCode);
    var hosp = safe(hospital);
    var phrase = 'To withdraw the amount from Drugs and Medication account, LBP Lingayen CA# ' + ac + ', ' + hosp + ', to be deposited to LBP Lingayen CA# 2422-1042-51 Trust Fund (4)-Common Fund';
    var rows = '<div class="row row-cols-3"><div class="col" style="padding: 10px; text-align: left; white-space: normal;">' + phrase + '</div><div class="col" style="padding: 10px; text-align: left;"></div><div class="col" style="padding: 10px; text-align: right;">P <input type="number" step="0.01" min="0" name="amount" id="receiptAmountInput" value="' + amountNum + '" style="width: 90%; text-align: right;" required></div></div>';
    receiptNatureRows.innerHTML = rows;
    if (totalAmountDisplay) totalAmountDisplay.textContent = formatNumberReceipt(amountNum);
    if (typeof updateAmountInWords === 'function') updateAmountInWords();
}

function populateGeneralToReceipt(particularName, amountStr, hospital, accountCode, quarter) {
    var receiptNatureRows = document.getElementById('receiptNatureRows');
    var totalAmountDisplay = document.getElementById('totalAmountDisplay');
    if (!receiptNatureRows) return;
    var amountNum = parseFloat(String(amountStr || '').replace(/,/g, '')) || 0;
    var safe = function(s) { return String(s || '').replace(/</g, '&lt;').replace(/>/g, '&gt;').trim(); };
    var hosp = safe(hospital);
    var ac = safe(accountCode);
    var qtr = safe(quarter);
    var phrase = 'To withdraw the amount from General Fund ' + hosp + ' Account No. ' + ac + ' for deposit to General Fund LBP Lingayen Account No. 2422-1000-51 representing income earned by ' + hosp + ' for the ' + qtr;
    var rows = '<div class="row row-cols-3"><div class="col" style="padding: 10px; text-align: left; white-space: normal;">' + phrase + '</div><div class="col" style="padding: 10px; text-align: left;"></div><div class="col" style="padding: 10px; text-align: right;">P <input type="number" step="0.01" min="0" name="amount" id="receiptAmountInput" value="' + amountNum + '" style="width: 90%; text-align: right;" required></div></div>';
    receiptNatureRows.innerHTML = rows;
    if (totalAmountDisplay) totalAmountDisplay.textContent = formatNumberReceipt(amountNum);
    if (typeof updateAmountInWords === 'function') updateAmountInWords();
}

function populateSimpleToReceipt(optParticularName, optAmountStr) {
    var particularsSelect = document.getElementById('particulars');
    var receiptNatureRows = document.getElementById('receiptNatureRows');
    var totalAmountDisplay = document.getElementById('totalAmountDisplay');
    if (!receiptNatureRows || !particularsSelect) return;
    var particularName = (optParticularName !== undefined && optParticularName !== null) ? String(optParticularName) : particularsSelect.value;
    var amountNum = 0;
    if (optAmountStr !== undefined && optAmountStr !== null && String(optAmountStr).trim() !== '') {
        amountNum = parseFloat(String(optAmountStr).replace(/,/g, '')) || 0;
    } else {
        var input = document.getElementById('simpleAmountInput');
        if (input) amountNum = parseFloat(input.value.replace(/,/g, '')) || 0;
    }
    var rows = '<div class="row row-cols-3"><div class="col" style="padding: 10px; text-align: left;">' + particularName.replace(/</g, '&lt;').replace(/>/g, '&gt;') + '</div><div class="col" style="padding: 10px; text-align: left;"></div><div class="col" style="padding: 10px; text-align: right;">P <input type="number" step="0.01" min="0" name="amount" id="receiptAmountInput" value="' + amountNum + '" style="width: 90%; text-align: right;" required></div></div>';
    receiptNatureRows.innerHTML = rows;
    if (totalAmountDisplay) totalAmountDisplay.textContent = formatNumberReceipt(amountNum);
    if (typeof updateAmountInWords === 'function') updateAmountInWords();
}

(function() {
    var form = document.getElementById('receiptForm');
    if (!form) return;
    form.addEventListener('submit', function() {
        var receiptNatureRows = document.getElementById('receiptNatureRows');
        var input = document.getElementById('natureOfCollectionInput');
        if (!receiptNatureRows || !input) return;
        var rows = receiptNatureRows.querySelectorAll('.row.row-cols-3');
        var lines = [];
        for (var i = 0; i < rows.length; i++) {
            var cols = rows[i].querySelectorAll('.col');
            if (cols.length >= 2) {
                var col1 = (cols[0].innerText || cols[0].textContent || '').trim().replace(/\s+/g, ' ');
                var col2 = (cols[1].innerText || cols[1].textContent || '').trim().replace(/\s+/g, ' ');
                lines.push(col2 ? (col1 + ' | ' + col2) : col1);
            }
        }
        input.value = lines.join('\n');
    });
})();
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
            <div class="col" style="padding: 10px;">
                <select id="checkBankInput" class="form-select" style="width: 100%;">
                    <option value="">— Select bank —</option>
                    @foreach($banks ?? [] as $bank)
                        <option value="{{ $bank->name }}">{{ $bank->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col" style="padding: 10px;"><input type="text" id="checkNumberInput" style="width: 100%; text-align: center;" placeholder="Check number"></div>
            <div class="col" style="padding: 10px;"><input type="date" id="checkDateInput" class="form-control" style="width: 100%;"></div>
        </div>
      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" id="checkModalEnterBtn" data-bs-dismiss="modal">Enter</button>
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
            <div class="col" style="padding: 10px;"><input type="text" id="moneyOrderNumberInput" class="form-control" style="width: 100%; text-align: center;" placeholder="Number"></div>
            <div class="col" style="padding: 10px;"><input type="date" id="moneyOrderDateInput" class="form-control" style="width: 100%;"></div>
        </div>
      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" id="moneyOrderModalEnterBtn" data-bs-dismiss="modal">Enter</button>
        </div>
    </div>
  </div>
</div>

<!-- Script for check and money order-->
<script>
    const checkboxes = document.querySelectorAll('#Cash, #Check, #MoneyOrder');

    checkboxes.forEach(box => {
        box.addEventListener('change', function () {
            checkboxes.forEach(cb => { if (cb !== this) cb.checked = false; });
            if (this.checked) {
                if (this.id === "Check") {
                    new bootstrap.Modal(document.getElementById('checkModal')).show();
                }
                if (this.id === "MoneyOrder") {
                    new bootstrap.Modal(document.getElementById('moneyOrderModal')).show();
                }
            }
        });
    });

    document.getElementById('checkModalEnterBtn').addEventListener('click', function() {
        var bank = document.getElementById('checkBankInput');
        var num = document.getElementById('checkNumberInput');
        var date = document.getElementById('checkDateInput');
        var bankVal = bank ? bank.value : '';
        var numVal = num ? num.value : '';
        var dateVal = date ? date.value : '';
        document.getElementById('receiptCheckBank').textContent = bankVal;
        document.getElementById('receiptCheckNumber').textContent = numVal;
        document.getElementById('receiptCheckDate').textContent = dateVal;
        var bankHidden = document.getElementById('checkBankHidden');
        var numHidden = document.getElementById('checkNumberHidden');
        var dateHidden = document.getElementById('checkDateHidden');
        if (bankHidden) bankHidden.value = bankVal;
        if (numHidden) numHidden.value = numVal;
        if (dateHidden) dateHidden.value = dateVal;
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
    var fillSampleBtn = document.getElementById('fillSampleBtn');
    if (fillSampleBtn) {
        fillSampleBtn.addEventListener('click', function() {
            var dateInput = document.querySelector('input[name="receipt_date"]');
            var orInput = document.querySelector('input[name="receipt_number"]');
            var payorInput = document.querySelector('input[name="payer_name"]');
            var particularsSelect = document.getElementById('particulars');
            if (dateInput) {
                var d = new Date();
                dateInput.value = d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0') + '-' + String(d.getDate()).padStart(2, '0');
            }
            if (orInput) orInput.value = String(Math.floor(1000000 + Math.random() * 9000000));
            if (payorInput) payorInput.value = 'Sample Payor';
            if (particularsSelect && particularsSelect.options.length > 1) {
                var simpleOpt = null;
                for (var i = 1; i < particularsSelect.options.length; i++) {
                    var o = particularsSelect.options[i];
                    var mt = (o.dataset && o.dataset.modalType) ? o.dataset.modalType.toLowerCase() : '';
                    if (mt !== 'settlement' && mt !== 'liquidation') {
                        simpleOpt = o;
                        break;
                    }
                }
                if (simpleOpt) {
                    window._fillSample = true;
                    particularsSelect.value = simpleOpt.value;
                    particularsSelect.dispatchEvent(new Event('change'));
                }
            }
        });
    }
    updateAmountInWords();
});
</script>
</body>
</html>
