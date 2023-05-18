@extends('layouts.staff')

@section('content')

    <div class="registration-form mt-3">



        <form action="javascript:void(0);" id="LeadForm">

            <div class="form-icon_2">

                <img src="{{ getSiteSettings()->company_logo }}" height="50px" alt="">

            </div>

        </form>

        <form action="{{ route('staff.yearly-report') }}" id="LeadForm" class="mt-2 p-2">

            <div class="row">

                {{-- <div class="col-md-4">

                    <div class="form-group">

                        <label>Mobile</label>

                        <input type="text" name="mobile" class="form-control" placeholder="Mobile"

                            value="{{ app('request')->input('mobile') }}">

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group">

                        <label>Taxi Number</label>

                        <input type="text" name="taxi_number" class="form-control" placeholder="Taxi Number"

                            value="{{ app('request')->input('taxi_number') }}">

                    </div>

                </div> --}}

                <div class="col-md-4">

                    <div class="form-group">

                        {{-- <label>Sales Person</label> --}}

                        @php

                            $sales_person = $curr_sales_person->id;

                            if (app('request')->input('sales_person')) {

                                $sales_person = app('request')->input('sales_person');

                            }

                        @endphp                        

                        <select class="form-control select2" name="sales_person">

                            <option value="">Select</option>

                            @if ($users && count($users) > 0)

                                @foreach ($users as $item)

                                    <option value="{{ $item->id }}" {{ $sales_person == $item->id ? 'selected' : '' }}>

                                        {{ $item->first_name }} {{ $item->last_name }}

                                    </option>

                                @endforeach

                            @endif

                        </select>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group">

                        <input type="month" class="form-control" id="checkin_date_time" placeholder="Name"

                            name="checkin_date_time" />

                    </div>

                </div>



                <div class="col-md-2">

                    <div class="form-group">

                        <button type="submit" class="btn btn-primary">Search

                        </button>

                        <button type="submit" name="export_pdf" value="export_pdf" class="btn btn-primary">Print </button>

                    </div>

                </div>

            </div>

        </form>



        <form action="javascript:void(0);" id="LeadForm" class="mt-2 p-2">

            <div class="row">

                <div class="col-md-12" style="overflow-y: scroll">

                    <table class="table table-bordered">

                        <thead class="thead-light">

                            <tr>

                                <th>

                                    Month

                                </th>

                                <th>

                                    Sale Amount

                                </th>

                                {{-- <th colspan="3" class="text-center">

                                    Mode Of Paymet

                                </th>

                                <th rowspan="2">Commission Amount

                                </th> --}}

                                <th>पाई (PAI)

                                </th>

                            </tr>

                            {{-- <tr>

                                <th>Cash

                                </th>

                                <th>Upi

                                </th>

                                <th>Card

                                </th>

                            </tr> --}}

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

                                {{-- {{dd($item)}} --}}

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

                                            <a

                                                href="{{ route('staff.sales-person-monthly-report', ['month' => $item->month, 'year' => $item->year, 'sales_person' => $sales_person]) }}">

                                                {{ date('F', mktime(0, 0, 0, $item->month, 10)) }}- {{ $item->year }}

                                            </a>



                                        </td>

                                        <td>{{ $item->total_amount }}</td>

                                        {{-- <td>{{ $item->total_cash_amount }} 

                                        </td>

                                        <td>{{ $item->total_upi_amount }}

                                        </td>

                                        <td>{{ $item->total_card_amount }}

                                        </td>

                                        <td>{{ $item->total_commission_amount }}

                                        </td> --}}

                                        <td>{{ $item->s }}</td>

                                    </tr>

                                @endforeach

                                <tr style="background:#e9ecef">

                                    <td>

                                        Total

                                    </td>

                                    <td>{{ $total_amount }}

                                        {{-- </td>

                                    <td>{{ $total_cash_amount }}

                                    </td>

                                    <td>{{ $total_upi_amount }}

                                    </td>

                                    <td>{{ $total_card_amount }}

                                    </td>

                                    <td>{{ $total_commission_amount }}

                                    </td> --}}

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

            </div>

        </form>

    </div>



@endsection

