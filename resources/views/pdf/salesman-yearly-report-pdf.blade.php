<!DOCTYPE html>
<html>

<head>
    <title>Report</title>
    <meta charset="utf-8">


    <style>
        /* RESET & BASIC STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
        @import url("https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap");

        :root {
            --white: #fff;
            --darkblue: #1b4965;
            --lightblue: #edf2f4;
        }

        * {
            padding: 0;
            margin: 0;
        }

        body {
            margin: 50px 0 150px;
            font-family: "Noto Sans", sans-serif;
        }

        .container {
            max-width: 1000px;
            padding: 0 15px;
            margin: 0 auto;
        }

        h1 {
            font-size: 1.5em;
        }

        /* TABLE STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
        .table-wrapper {
            overflow-x: auto;
            padding-right: 15px;
            padding-left: 15px;
        }

        .table-wrapper::-webkit-scrollbar {
            height: 8px;
        }

        .table-wrapper::-webkit-scrollbar-thumb {
            background-color: #c1c1c1;
            border-radius: 40px;
        }

        .table-wrapper::::-webkit-scrollbar-track {
            background: var(--white);
            border-radius: 40px;
        }

        .table-wrapper table {
            margin: 50px 0 20px;
            border-collapse: collapse;
            text-align: center;
        }

        .table-wrapper table th,
        .table-wrapper table td {
            padding: 10px;
            min-width: 75px;
        }

        .table-wrapper table th {
            color: var(--white);
            background: #c1c1c1;
        }

        .table-wrapper table tbody tr:nth-of-type(even)>* {
            background: var(--lightblue);
        }

        .table-wrapper table td:first-child {
            display: grid;
            grid-template-columns: 25px 1fr;
            grid-gap: 10px;
            text-align: left;
        }

        .table-credits {
            font-size: 12px;
            margin-top: 10px;
        }

        .total_table {
            font-weight: 800;
            color: #000;
            border: 2px solid #c1c1c1;
        }

        tr {
            border-bottom: 1px solid #ddd;
        }

        .heading_text {
            font-size: 42px;
            font-weight: 800;
            text-align: center;
            font-family: Sans-Serif !important;
        }
    </style>
</head>

<body>

    <div>
        <p class="heading_text">Yearly Report</p>
    </div>

    <div class="table-wrapper">
        <table class="table table-bordered">
            <thead class="thead-light">

                <tr>

                    <th>

                        Month

                    </th>

                    <th>

                        Sale Amount

                    </th>

                    <th>पाई (PAI)

                    </th>

                </tr>

                
            </thead>

            <tbody>

                @if (!empty($customers) && count($customers) > 0)

                    @php

                        $total_amount = 0;

                        $total_cash_amount = 0;

                        $total_upi_amount = 0;

                        $total_card_amount = 0;

                        $total_commission_amount = 0;

                        $total_pai_amount = 0;

                    @endphp

                    @foreach ($customers as $key => $item)

                        @php

                            $total_amount = $total_amount + $item->total_amount;

                            $total_cash_amount = $total_amount + $item->total_cash_amount;

                            $total_upi_amount = $total_amount + $item->total_upi_amount;

                            $total_card_amount = $total_amount + $item->total_card_amount;

                            $total_commission_amount = $total_amount + $item->total_commission_amount;

                            $total_pai_amount = $total_pai_amount + $item->s;

                        @endphp

                        <tr>

                            <td>
                                {{ date('F', mktime(0, 0, 0, $item->month, 10)) }}- {{ $item->year }}SSS
                            </td>

                            <td>{{ $item->total_amount }}</td>

                            
                            <td>{{ $item->s }}</td>

                        </tr>

                    @endforeach

                    <tr style="background:#e9ecef">

                        <td>
                            Total
                        </td>
                        <td>{{ $total_amount }}
                        <td>{{ $total_pai_amount }}
                        </td>
                    </tr>
                @else

                    <tr>

                        <td colspan="3" class="text-center">

                            <strong>No Data Found </strong>

                        </td>

                    </tr>

                @endif

            </tbody>
        </table>
    </div>


</body>

</html>
