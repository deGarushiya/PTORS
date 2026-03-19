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
        <!-- DATE TO PAYOR -->
        <tr>
            <td style="padding-top: 175px;">{{ $receipt->receipt_date->format('F j, Y') }}</td>
            <td></td>
        </tr>

        <tr>
            <td style="height:30px;"></td>
        </tr>
        <!-- <tr>
            <td style="padding-top: 15px;">
                PROVINCIAL TREASURY OFFICE
            </td>
            <td style="padding-top: 15px; text-align: right; min-width: 75px">
                {{ $fundCode ?? '100' }}
            </td>
        </tr> -->
        <tr>
            <td colspan="2">{{ $receipt->payer_name }}</td>
        </tr>
    </table>
    <table>
        <!-- PARTICULAR TO AMOUNT IN WORDS (nature/account from modal when saved) -->
        @php
            $natureLines = [];
            $accountLines = [];
            if (!empty($receipt->nature_of_collection)) {
                foreach (explode("\n", $receipt->nature_of_collection) as $line) {
                    $parts = explode(' | ', $line, 2);
                    $natureLines[] = trim($parts[0] ?? '');
                    $accountLines[] = trim($parts[1] ?? '');
                }
            }
        @endphp
        <tr>
            <td style="font-size: 15px; height:230px; padding-top:18px; overflow:hidden; vertical-align: top; white-space:pre-line;">
                @if(count($natureLines))
                    {{ implode("\n", $natureLines) }}
                @else 
                    Nature of collection 
                @endif
            </td>
            <td style="height:230px; padding-top:25px; overflow:hidden; vertical-align: top; white-space:pre-line;">
                @if(count($accountLines))
                    {{ implode("\n", $accountLines) }}
                @else 
                    Account Code 
                @endif
            </td>
            <td style="height:230px; padding-top:20px; overflow:hidden; white-space:pre-line; text-align:right; vertical-align: top; min-width: 82px;">
                    {{ number_format($receipt->amount,2) }}
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td style="text-align: right;">{{ number_format($receipt->amount,2) }}</td>
        </tr>
        <tr>
            <td colspan="3" style="height:50px;">{{ $amountInWords ?? 'Zero and 00/100 pesos only' }}</td>
        </tr>
    </table>
    <table>
        <!-- PAYMENT METHOD -->
        {{-- Payment method: 1 = Cash, 2 = Check, 3 = Money Order — only the selected one shows X --}}
        <tr>
            <td colspan="4" style="height:15px;">{{ $receipt->payment_method === 'Cash' ? 'X' : '' }}</td>
        </tr>
        <tr>
            <td style="height:15px; vertical-align: top;">{{ $receipt->payment_method === 'Check' ? 'X' : '' }}</td>
            <td style="text-align: right; height:15px; width:150px; vertical-align: top;">{{ $receipt->payment_method === 'Check' ? trim(($receipt->check_bank_name ?? '') . ($receipt->check_branch_name ? ' (' . $receipt->check_branch_name .')' : '')) : '' }}</td>
            <td style="text-align: right; height:15px; width:40px; vertical-align: top;">{{ $receipt->payment_method === 'Check' ? ($receipt->check_number ?? '') : '' }}</td>
            <td style="text-align: right; height:15px; width:50px; vertical-align: top;">{{ $receipt->payment_method === 'Check' ? ($receipt->check_date ? $receipt->check_date->format('m-d-Y') : '') : '' }}</td>
        </tr>
        <tr>
            <td style="height:15px; vertical-align: top;">{{ $receipt->payment_method === 'Money Order' ? 'X' : '' }}</td>
            <td></td>
            <td style="text-align: right; height:15px; width:40px; vertical-align: top;">{{ $receipt->payment_method === 'Money Order' ? ($receipt->check_number ?? '') : '' }}</td>
            <td style="text-align: right; height:15px; width:50px; vertical-align: top;">{{ $receipt->payment_method === 'Money Order' ? ($receipt->check_date ? $receipt->check_date->format('m-d-Y') : '') : '' }}</td>
        </tr>

        <tr>
            <td colspan="4" style="padding-top: 30px; padding-right: 10px; font-size: 20px; text-align: right">ALMA C. CRUZ</td>
        </tr>
    </table>
</body>
</html>