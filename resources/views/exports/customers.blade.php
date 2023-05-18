<table>
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
            <th>Men</th>
            <th>Women</th>
            <th>Children</th>
            <th>Checkin date time</th>
            <th>Checkout date time</th>
            <th>Sell</th>
            <th>Date</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @php
            $count = 1;
        @endphp

        @if (!empty($customers) && count($customers) > 0)
            @foreach ($customers as $key => $item)
                <tr>
                    <td>
                        {{ $count }}
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->mobile }}</td>
                    <td>{{ $item->taxi_number }}</td>
                    <td>{{ $item->vehicle }}</td>
                    <td>{{ $item->stay_time }}</td>
                    <td>{{ $item->user ? $item->user->first_name . ' ' . $item->user->last_name : '-' }}
                    </td>
                    <td>{{ $item->payment_mode }}</td>
                    <td>{{ $item->amount }}</td>
                    <td>{{ $item->bill_number }}</td>

                    <td>{{ $item->men }}</td>
                    <td>{{ $item->women }}</td>
                    <td>{{ $item->children }}</td>
                    <td>{{ $item->checkin_date_time ? date('d-m-Y H:i:s', strtotime($item->checkin_date_time)) : '-' }}
                    </td>
                    <td>{{ $item->checkout_date_time ? date('d-m-Y H:i:s', strtotime($item->checkout_date_time)) : '-' }}
                    </td>
                    <td>{{ $item->is_sell == 1 ? 'Yes' : 'No' }}</td>
                    <td>
                        {{ date('d-m-Y', strtotime($item->created_at)) }}
                    </td>
                    <td>{!! $item->description !!}</td>
                </tr>
                @php
                    $count++;
                @endphp
            @endforeach
        @endif
    </tbody>
</table>
