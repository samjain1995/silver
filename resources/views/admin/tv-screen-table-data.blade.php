@if (!empty($customers) && count($customers) > 0)
    @foreach ($customers as $key => $item)
        <tr>
            <td>
                {{ $key + 1 }}
            </td>
            @php
                $display_name = $item->taxi_number;
                if ($item->vehicle == 'Guide') {
                    $display_name = $item->name;
                }
            @endphp
            <td>{{ $item->vehicle }} ({{ $display_name }})</td>
            <td>{{ date('H:i:s A', strtotime($item->checkin_date_time)) }}</td>
            <td>{{ $item->user ? $item->user->first_name . ' ' . $item->user->last_name : '-' }}</td>
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
