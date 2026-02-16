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

        .print-btn {
            width: 50%;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            border: solid 3px #0d0875;
            color: #0d0875;
            background-color: #fff;
        }

        .print-btn:hover {
            background: #0d0875;
            border: solid 3px #0d0875;
            color: white;
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
                <a class="nav-link active" href="{{ route('user') }}">New receipt</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('report') }}">View reports</a>
            </li>
            <li class="nav-item ms-auto" style="margin-right: 10px">
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-link nav-logout-btn">Log out</button>
                </form>
            </li>
        </ul>
    </nav>

    <div class="receipt-container">
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
                <div class="col" style="padding: 10px; text-align: left;">DATE <input type="date" name="date" style="width: 100%;"></div>
                <div class="col" style="padding: 10px;"><input placeholder="Official Receipt No" type="text" name="OR_no" style="width: 100%; height: 52px; text-align: center;"></div>
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
                <div class="col" style="padding: 10px; text-align: left;">Payor <input type="text" name="payor" style="width: 100%;"></div>
            </div>
        </div>
        <div class="container text-center">
            <div class="row row-cols-1">
                <div class="col" style="padding: 10px; text-align: left;">Particulars 
                    <select id="particulars" name="particulars" style="width: 50%; height: 30px;">
                        <option value="#"></option>
                        <option value="Settlement">Settlement of Cash Advance</option>
                        <option value="Remittance">Remittance of Banaan Provincial Museum Shop Sale</option>
                        <option value="Payment">Payment of 25% Government LGU Share</option>
                        <option value="Refund">Refund of Unexpected Cash Advance</option>
                        <option value="Cancelled">Cancelled OR</option>
                        <option value="Partial">Partial Payment of Loan</option>
                        <option value="Maip">Maip</option>
                    </select>
                </div>
            </div>
            <div class="row row-cols-3">
                <div class="col">Nature of Collection</div>
                <div class="col">Account Code</div>
                <div class="col">Amount</div>
            </div>
            <div class="row row-cols-3">
                <div class="col"></div>
                <div class="col"></div>
                <div class="col" style="text-align: left;">P </div>
            </div>
            <div class="row row-cols-3">
                <div class="col"><b>TOTAL</b></div>
                <div class="col"></div>
                <div class="col" style="text-align: left;">P </div>
            </div>
            <div class="row row-cols-1">
                <div class="col" style="padding: 10px; text-align: left;">Amount in words </div>
            </div>
        </div>
        <div class="container text-center">
            <div class="row row-cols-4" style="border:solid 1px #000;">
                <div class="col" style="border:none; text-align: left;">
                    <input type="checkbox" id="Cash" name="Cash" value="Cash">
                    <label for="Cash"> Cash</label>
                </div>
                <div class="col">Bank name</div>
                <div class="col">Check number</div>
                <div class="col">Date</div>
                
                <div class="col" style="border:none; text-align: left;">
                    <input type="checkbox" id="Check" name="Check" value="Check">
                    <label for="Check"> Check</label>
                </div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
                
                <div class="col" style="border:none; text-align: left;">
                    <input type="checkbox" id="Money Order" name="Money Order" value="Money Order">
                    <label for="Money Order"> Money Order</label>
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
                    <br>ALMA CRUZ
                    <br>______________________
                    <br> Collecting Officer
                    </h6>
                </div>
            </div>
            <div class="row row-cols-1" style="background-color: #ffffff !important;">
                <div class="col" style="border:none">
                    <p style="font-size: 12px; text-align: left;">
                        NOTE: Write the number and date of this receipt on the back of check or money order received.
                    </p> 
                </div>
            </div>
        </div>
        <div class="container text-center" style="background-color: #ffffff !important;">
            <button type="submit" class="print-btn">Print</button>
        </div>
    </div>

    <footer>
        <p>@2026</p>
    </footer>

    <!-- Modal -->
<div class="modal fade" id="particularsModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalContent"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.getElementById("particulars").addEventListener("change", function() {

    let selectedText = this.options[this.selectedIndex].text;

    if (this.value !== "#") {

        document.getElementById("modalContent").innerText =
            selectedText;

        let modal = new bootstrap.Modal(
            document.getElementById('particularsModal')
        );

        modal.show();
    }

});
</script>
</body>
</html>
