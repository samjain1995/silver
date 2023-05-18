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
                    <th>
                        #
                    </th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Taxi Number</th>
                    <th>Vehicle</th>
                    <th>Stay Time</th>
                    <th>Sales Person</th>
                    <th>Payment Mode</th>
                    <th>Bill Amount</th>
                    <th>Bill Number</th>
                    <th>Checkin Date Time</th>
                    <th>Checkout Date Time</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 1;
                @endphp

                @if (!empty($results) && count($results) > 0)
                    @foreach ($results as $key => $item)
                        <tr>
                            <td>
                                {{ $count }}
                            </td>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>{{ $item->mobile }}</td>
                            <td>{{ $item->taxi_number }}</td>
                            <td>{{ $item->vehicle }}</td>
                            <td>{{ $item->getStayTimeAttribute($item->checkin_date_time, $item->checkout_date_time) }}
                            </td>
                            <td>
                                <a href="javascript:void(0);" ng-click="showCustomer({{ $key }})">
                                    (@if ($item->is_textile == 1)
                                        सीधा नेशनल
                                    @endif
                                    @if ($item->user && $item->user->id != 14)
                                        {{ $item->user ? $item->user->first_name . ' ' . $item->user->last_name : '-' }}
                                    @endif)
                                </a>

                            </td>
                            <td>{{ $item->payment_mode }}</td>
                            <td>{{ $item->amount }}</td>
                            <td>{{ $item->bill_number }}</td>
                            <td>
                                {{ date('d-m-Y H:i:s A', strtotime($item->checkin_date_time)) }}
                            </td>
                            <td>
                                @if ($item->checkout_date_time)
                                    {{ date('d-m-Y H:i:s A', strtotime($item->checkout_date_time)) }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                {{ date('d-m-Y', strtotime($item->created_at)) }}
                            </td>
                        </tr>
                        @php
                            $count++;
                        @endphp
                    @endforeach
                @else
                    <tr>
                        <td colspan="11" class="text-center">
                            <strong>No Data Found</strong>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

</body>

</html>
