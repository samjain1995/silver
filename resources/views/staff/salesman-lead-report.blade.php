@extends('layouts.staff')





@section('content')

    <div class="registration-form mt-3">



        <form action="javascript:void(0);" id="LeadForm">

            <div class="form-icon_4">

                <img src="{{ getSiteSettings()->company_logo }}" height="50px" alt="">

            </div>



            <div class="form-icon">



                <!-- <a href="{{ route('staff.monthly-report') }}">

                    <i class="fa-solid fa-list fa-lg ml-1 mt-4"></i>

                </a> -->

                <a href="{{ route('staff.yearly-report') }}">

                    <i class="fa-solid fa-list fa-lg ml-1 mt-4 section_logo_top_11"></i>

                </a>

            </div>

        </form>



        <form action="{{ route('staff.salesman-lead-report') }}" id="LeadForm" class="mt-2 p-2">

            <div class="row">

                <div class="col-md-4">

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

                </div>

                <div class="col-md-4">

                    <div class="form-group">

                        <label>Sales Person</label>

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

                                    <option value="{{ $item->id }}">

                                        {{ $item->first_name }} {{ $item->last_name }}

                                    </option>

                                @endforeach

                            @endif

                        </select>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group">

                        <input type="date" class="form-control" id="checkin_date_time" placeholder="Name"

                            value="{{date('Y-m-d')}}"

                            name="checkin_date_time" />

                    </div>

                </div>



                <div class="col-md-2">

                    <div class="form-group">

                        <button type="submit" class="btn btn-primary">Search </button>
                        <button type="submit" name="export_pdf" value="export_pdf" class="btn btn-primary">Print </button>

                    </div>

                </div>

            </div>

        </form>



        <form action="javascript:void(0);" id="LeadForm" class="mt-2 p-2">

            <div class="row">

                <div class="col-md-12" style="overflow-y: scroll">

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

                        @endphp @if (!empty($customers) && count($customers) > 0)

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

            </div>

        </form>

    </div>

@endsection

@section('scripts')

    <script type="text/javascript">

    </script>

@endsection

