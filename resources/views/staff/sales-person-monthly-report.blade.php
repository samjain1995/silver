@extends('layouts.staff')


@section('content')
    <div class="registration-form mt-3">

        <form action="javascript:void(0);" id="LeadForm">
            <div class="form-icon">
                <img src="{{ getSiteSettings()->company_logo }}" height="50px" alt="">
            </div>

            <div class="form-icon">

                <a href="{{ route('staff.monthly-report') }}">
                    <i class="fa-solid fa-list fa-lg ml-1 mt-4"
                        style="color: #04345d; margin-left: 200px !important;  margin-top: -80px !important"></i>
                </a>

                <a href="{{ route('staff.yearly-report') }}">
                    <i class="fa-solid fa-list fa-lg ml-1 mt-4"
                        style="color: #04345d; margin-left: 200px !important;  margin-top: -80px !important"></i>
                </a>
            </div>


        </form>

        <form action="{{ route('staff.salesman-lead-report') }}" id="LeadForm" class="mt-2 p-2">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <input type="date" class="form-control item" name="checkin_date_time" id="checkin_date_time"
                            value="{{ app('request')->input('checkin_date_time') ? app('request')->input('checkin_date_time') : date('Y-m-d') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-block create-account trigger-btn" style="margin-top: 0">
                        Search
                    </button>
                </div>
            </div>
        </form>

        <form action="javascript:void(0);" id="LeadForm" class="mt-2 p-2">
            <div class="row">
                <div class="col-md-12" style="overflow-y: scroll">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 20px;">
                                    #
                                </th>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Bill Number
                                </th>
                                <th>
                                    Sale Amount
                                </th>
                                <th>पाई (pai)
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = app('request')->input('page') && app('request')->input('page') > 1 ? (app('request')->input('page') - 1) * 50 + 1 : 1;
                                $total = 0;
                                $total_commission_amount = 0;
                            @endphp
                            @if (!empty($customers) && count($customers) > 0)
                                @foreach ($customers as $key => $item)
                                    @php
                                        $total = $total + $item->amount;
                                        $total_commission_amount = $total_commission_amount + $item->pai;
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox"> {{ $count }} </div>
                                        </td>
                                        <td>{{ date('d-m-Y', strtotime($item->checkin_date_time)) }}</td>
                                        <td>{{ $item->bill_number }}
                                        </td>
                                        <td>{{ $item->amount }}
                                        </td>
                                        <td>{{ $item->pai }}
                                        </td>
                                    </tr>
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach
                                {{-- @if (Auth::user()->role_id == 3) --}}
                                <tr style="background:#e9ecef">
                                        <td colspan="3" class="text-center">Total </td>
                                         <td> {{ $total }} </td>
                                        <td>{{ $total_commission_amount }}</td>
                                    </tr>
                                {{-- @endif --}}
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
    <script type="text/javascript"></script>
@endsection
