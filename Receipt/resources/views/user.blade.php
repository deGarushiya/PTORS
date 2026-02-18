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

    @if(session('error'))
        <div class="alert alert-warning mx-3 mt-3" role="alert">{{ session('error') }}</div>
        @endif
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
                    <input type="checkbox" id="MoneyOrder" name="MoneyOrder" value="MoneyOrder">
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
            <div class="row row-cols-1" style="background-color: #ffffff !important;">
                <div class="col" style="border:none">
                    <p style="font-size: 12px; text-align: left;">
                        NOTE: Write the number and date of this receipt on the back of check or money order received.
                    </p> 
                </div>
            </div>
        </div>
        <div class="container text-center" style="background-color: #ffffff !important;">
            <button type="submit" class="btn btn-secondary" style="width: 50%;">Print</button>
        </div>
    </div>

    <footer>
        <p>@2026</p>
    </footer>

    <!-- Modal -->
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
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Enter</button>
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

    if (value === "#") return;

    let content = "";

    switch(value) {

        case "Settlement":
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
                    <div class="col" style="text-align: left; padding: 10px;">P <input type="text" name="" style="width: 90%; text-align: right;"></div>
                </div>
                <div class="row row-cols-3">
                    <div class="col" style="padding: 10px;">Cash Advance</div>
                    <div class="col" style="padding: 10px;"><input type="text" name="" style="width: 100%; text-align: center;"></div>
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
                    <div class="col" style="padding: 10px; text-align: center;">(Auto Computation of Total RCDs)</div>
                    <div class="col"></div>
                </div>
                <div class="row row-cols-3">
                    <div class="col" style="padding: 10px;">Cash Refund</div>
                    <div class="col" style="padding: 10px; text-align: center;">(Auto Computation of Cash Advance and Total RCDs)</div>
                    <div class="col"></div>
                </div>
                <div class="row row-cols-3">
                    <div class="col" style="padding: 10px;"><b>TOTAL</b></div>
                    <div class="col"></div>
                    <div class="col" style="text-align: left; padding: 10px;">P <input type="text" placeholder="total" disabled style="width: 90%; text-align: right;"></div>
                </div>
            </div>
            `;
        break;

        case "Remittance":
            modalTitle.innerText = "Remittance of Museum Shop Sale";
            content = `
                <div class="row">
                    <div class="col-6">Total Sales</div>
                    <div class="col-6"><input type="text" class="form-control"></div>
                </div>
            `;
        break;

        case "Payment":
            modalTitle.innerText = "Payment of 25% LGU Share";
            content = `
                <div class="row">
                    <div class="col-6">LGU Share</div>
                    <div class="col-6"><input type="text" class="form-control"></div>
                </div>
            `;
        break;

        case "Refund":
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

    if (value === "Settlement") {

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
                            <input type="text"
                                name="rcd[]"
                                placeholder="RCD ${i}"
                                style="width: 100%; text-align: center;">
                        </div>
                        <div class="col"></div>
                        <div class="col"></div>
                    </div>
                `;
            }
        }

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

<!-- Script for RCD-->
<script>
const rcdCountInput = document.getElementById("rcdCount");
const rcdContainer = document.getElementById("rcdContainer");

// Auto generate kapag nag change ng number
rcdCountInput.addEventListener("input", function () {
    generateRCDInputs(parseInt(this.value) || 0);
});

function generateRCDInputs(count) {
    rcdContainer.innerHTML = "";

    for (let i = 1; i <= count; i++) {
        rcdContainer.innerHTML += `
            <div class="row row-cols-3" style="margin-bottom:5px;">
                <div class="col" style="padding: 10px;">
                    <input type="text" 
                           name="rcd[]" 
                           placeholder="RCD ${i}" 
                           style="width: 100%; text-align: center;">
                </div>
                <div class="col"></div>
                <div class="col"></div>
            </div>
        `;
    }
}

// Manual add
function addRCD() {
    let current = parseInt(rcdCountInput.value) || 0;
    rcdCountInput.value = current + 1;
    generateRCDInputs(current + 1);
}

// Manual remove
function removeRCD() {
    let current = parseInt(rcdCountInput.value) || 0;
    if (current > 0) {
        rcdCountInput.value = current - 1;
        generateRCDInputs(current - 1);
    }
}
</script>

<!-- Check Modal -->
<div class="modal fade" id="checkModal">
  <div class="modal-dialog" style="max-width: 900px; overflow-y: auto;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="font-weight: bold;">Check Information</h5>
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
<div class="modal fade" id="moneyOrderModal">
  <div class="modal-dialog" style="max-width: 900px; overflow-y: auto;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="font-weight: bold;">Money Order Information</h5>
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
</body>
</html>
