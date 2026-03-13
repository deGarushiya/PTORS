<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page {
            margin-top: 0;
            margin-left: 20px;
            margin-right: 0px;
        }

        body{
            font-family: "Lucida Console", "Courier New", monospace;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .container{
            width:100%;
        }

        table{
            width:44%;
            border-collapse: collapse;
        }

        td{
            padding:5px;
        }

        @media print {
            body{
                margin-top: 0;
                margin-left: 20px;
                margin-right: 0px;
                padding:0;
            }
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <td colspan="2" style="padding-top: 175px;">{{ $receipt->receipt_date->format('F j, Y') }}</td>
            <td colspan="2"></td>
        </tr>

        <tr>
            <td colspan="3" style="padding-top: 15px;">PROVINCIAL TREASURY OFFICE</td>
            <td style="padding-top: 15px; text-align: right;">{{ $fundCode ?? '100' }}</td>
        </tr>
        <tr>
            <td colspan="4">{{ $receipt->payer_name }}</td>
        </tr>

        <tr>
            <td colspan="2"></td>
            <td></td>
            <td style="padding-top: 43px; text-align: right;">{{ number_format($receipt->amount,2) }}</td>
        </tr>
        <tr>
            <td colspan="2" style="padding-bottom: 190px;"></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td></td>
            <td style="padding-top: 10px; text-align: right;">{{ number_format($receipt->amount,2) }}</td>
        </tr>
        <tr>
            <td colspan="4" style="padding-top: 28px;">{{ $amountInWords ?? 'Zero and 00/100 pesos only' }}</td>
        </tr>
        {{-- Payment method: 1 = Cash, 2 = Check, 3 = Money Order — only the selected one shows X --}}
        <tr>
            <td>{{ $receipt->payment_method === 'Cash' ? 'X' : '' }}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>{{ $receipt->payment_method === 'Check' ? 'X' : '' }}</td>
            <td>{{ $receipt->payment_method === 'Check' ? ($receipt->check_bank_name ?? '') : '' }}</td>
            <td>{{ $receipt->payment_method === 'Check' ? ($receipt->check_number ?? '') : '' }}</td>
            <td>{{ $receipt->payment_method === 'Check' ? ($receipt->check_date ? $receipt->check_date->format('Y-m-d') : '') : '' }}</td>
        </tr>
        <tr>
            <td>{{ $receipt->payment_method === 'Money Order' ? 'X' : '' }}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td colspan="2" style="padding-top: 40px; font-size: 20px">ALMA CRUZ</td>
        </tr>

    </table>
</body>
</html>