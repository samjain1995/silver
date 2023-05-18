<!DOCTYPE html>
<html lang="en">

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
        <p class="heading_text">Customers List</p>
    </div>

    <div class="table-wrapper">
        <table class="table table-bordered">
            <thead>

                <tr>

                    <th style="width: 20px;" rowspan="2">
                        #
                    </th>
                    <th rowspan="2">
                        Number
                    </th>
                    <th rowspan="2">
                        P आने का समय
                    </th>
                    <th rowspan="2">
                        Sales Person
                    </th>
                    <th rowspan="2">
                        Bill Number
                    </th>
                    <th rowspan="2">
                        Sale Amount
                    </th>
                    <th colspan="3" class="text-center">
                        Mode Of Payment
                    </th>
                    <th rowspan="2">छबी % (Commission)
                    </th>
                    <th rowspan="2">Textile Sale
                    </th>
                    <th rowspan="2">Commission
                    </th>
                    <th rowspan="2">पाई (pai)
                    </th>
                </tr>
                <tr>
                    <th>Cash
                    </th>
                    <th>Upi
                    </th>
                    <th>Card
                    </th>
                </tr>
            </thead>
            <tbody> @php
                $count = app('request')->input('page') && app('request')->input('page') > 1 ? (app('request')->input('page') - 1) * 50 + 1 : 1;
                $total = 0;
                $total_cash_amount = 0;
                $total_upi_amount = 0;
                $total_card_amount = 0;
                $total_commission_amount = 0;
            @endphp
                @if (!empty($customers) && count($customers) > 0)
                    @foreach ($customers as $key => $item)
                        @php
                            $total = $total + $item->amount;
                            $total_cash_amount = $total_cash_amount + $item->cash_amount;
                            $total_upi_amount = $total_upi_amount + $item->upi_amount;
                            $total_card_amount = $total_card_amount + $item->card_amount;
                            $total_commission_amount = $total_commission_amount + $item->commission_amount;
                        @endphp
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox"> {{ $count }} </div>
                            </td>
                            <td>
                                {{ $item->vehicle }}
                                {{ $item->taxi_number ? '(' . $item->taxi_number . ')' : '' }}
                            </td>
                            <td>{{ date('H:i:s A', strtotime($item->checkin_date_time)) }}</td>
                            <td>
                                (@if ($item->is_textile == 1)
                                    सीधा नेशनल
                                @endif
                                @if ($item->user && $item->user->id != 14)
                                    {{ $item->user ? $item->user->first_name . ' ' . $item->user->last_name : '-' }}
                                @endif)
                            </td>
                            <td>{{ $item->bill_number }}
                            </td>
                            <td>{{ $item->amount }}
                            </td>
                            <td>{{ $item->cash_amount }}
                            </td>
                            <td>{{ $item->upi_amount }}
                            </td>
                            <td>{{ $item->card_amount }}
                            </td>
                            <td>{{ $item->commission }} %
                            </td>
                            <td>-</td>
                            <td>{{ $item->commission_amount }}
                            </td>
                            <td>{{ $item->pai }}
                            </td>
                        </tr>
                        @php
                            $count++;
                        @endphp
                    @endforeach
                    @if (Auth::user()->role_id == 3)
                        <tr>
                            <td colspan="5"> Total </td>
                            <td> {{ $total }} </td>
                            <td>{{ $total_cash_amount }} </td>
                            <td>{{ $total_upi_amount }} </td>
                            <td>{{ $total_card_amount }} </td>
                            <td>-</td>
                            <td> 0</td>
                            <td>{{ $total_commission_amount }} </td>
                            <td></td>
                        </tr>
                    @endif
                @else
                    <tr>
                        <td colspan="12" class="text-center">
                            <strong>No Data Found </strong>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

</body>

</html>
