@if (!empty($customers) && count($customers) > 0)


    @foreach ($customers as $key => $item)
        <tr>


            <td>


                {{ $key + 1 }}


            </td>


            {{-- <td>{{ $item->name }}</td>


            <td>{{ $item->mobile }}</td> --}}


            <td>{{ $item->taxi_number }}</td>


            {{-- <td>{{ $item->vehicle }}</td>


            <td>{{ $item->stay_time }}</td> --}}


            <td>{{ $item->user ? $item->user->first_name . ' ' . $item->user->last_name : '-' }}
                
            </td>


            {{-- <td>{{ $item->payment_mode }}</td>


            <td>{{ $item->amount }}</td>


            <td>{{ $item->bill_number }}</td>


            <td>


                {{ date('d-m-Y', strtotime($item->created_at)) }}


            </td> --}}


            <td>
                @if ($item->couple)
                    {{ $item->couple }} कपल
                @endif
                @if ($item->children)
                    + {{ $item->children }} बच्चे
                @endif
                @if ($item->men)
                    + {{ $item->men }} पुरुष
                @endif
                @if ($item->women)
                    + {{ $item->women }} महिला
                @endif
            </td>


        </tr>
    @endforeach
@else
    <tr>


        <td colspan="10" class="text-center">


            <strong>No Data Found</strong>


        </td>


    </tr>


@endif
