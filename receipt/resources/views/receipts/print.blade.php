<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body{
            font-family: "Lucida Console", "Courier New", monospace;
            font-size: 12px;
            margin: 0;
        }
        .container{
            width:100%;
        }
        table{
            width:45%;
            border-collapse: collapse;
        }
        td{
            padding:5px;
        }
    </style>
</head>

<body>
    <table border="1" size="">
        <tr>
            <td colspan="2" style="padding-top: 50px;">{{ $receipt->receipt_date }}</td>
            <td colspan="2"></td>
        </tr>

        <tr>
            <td colspan="3">PROVINCIAL TREASURY OFFICE</td>
            <td>100</td>
        </tr>
        <tr>
            <td colspan="4">{{ $receipt->payer_name }}</td>
        </tr>

        <tr>
            <td colspan="2"></td>
            <td></td>
            <td style="padding-top: 50px;">P {{ number_format($receipt->amount,2) }}</td>
        </tr>
        <tr>
            <td colspan="4">AMOUNT IN WORDS</td>
        </tr>

        <tr>
            <td>CASH</td>
            <td>DRAWEE BANK</td>
            <td>NUMBER</td>
            <td>DATE</td>
        </tr>
        <tr>
            <td>CHECK</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>MONEY ORDER</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td colspan="2" style="padding-top: 50px;">ALMA CRUZ</td>
        </tr>

    </table>
</body>
</html>