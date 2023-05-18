<table>
    <thead>
        <tr>
            <th>
                <div class="custom-control custom-checkbox">
                    S. No.
                </div>
            </th>
            <th rowspan="2">Taxi Number</th>
            <th rowspan="2">Sales Person</th>
            <th rowspan="2">Bill Number</th>
            <th rowspan="2"> Sale Amount</th>
            <th colspan="3" style="text-align: center">Mode Of Paymet</th>
            th rowspan="2">Commission</th>
            <th rowspan="2">Textile Sale</th>
            <th rowspan="2">Commission</th>
        </tr>
        <tr>
            <th>Cash</th>
            <th>Upi</th>
            <th>Card</th>
        </tr>
    </thead>
    <tbody>
        @php
            $count = 1;
            $total = 0;
            $total_cash_amount = 0;
            $total_upi_amount = 0;
            $total_card_amount = 0;
        @endphp

        @if (!empty($customers) && count($customers) > 0)
            @foreach ($customers as $key => $item)
                @php
                    $total = $total + $item->amount;
                    $total_cash_amount = $total_cash_amount + $item->cash_amount;
                    $total_upi_amount = $total_upi_amount + $item->upi_amount;
                    $total_card_amount = $total_card_amount + $item->card_amount;
                @endphp
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            {{ $count }}
                        </div>
                    </td>
                    <td>{{ $item->taxi_number }}</td>
                    <td>{{ $item->user ? $item->user->first_name . ' ' . $item->user->last_name : '-' }}
                    </td>
                    <td>{{ $item->bill_number }}</td>
                    <td>{{ $item->amount }}</td>

                    <td>{{ $item->cash_amount }}</td>
                    <td>{{ $item->upi_amount }}</td>
                    <td>{{ $item->card_amount }}</td>

                    <td>-</td>
                    <td>-</td>
                    <td>-</td>



                </tr>
                @php
                    $count++;
                @endphp
            @endforeach

            <tr>
                <td colspan="4">
                    Total
                </td>
                <td>{{ $total }}</td>
                <td>{{ $total_cash_amount }}</td>
                <td>{{ $total_upi_amount }}</td>
                <td>{{ $total_card_amount }}</td>
                <td colspan="3"></td>

            </tr>
        @else
        @endif
    </tbody>
</table>
