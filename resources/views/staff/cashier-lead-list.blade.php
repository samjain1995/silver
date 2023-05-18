@extends('layouts.staff')
@section('content')
    <div class="registration-form">
        <form style="margin-top: 100px;">
            <div class="form-icon">
                <img src="{{ getSiteSettings()->company_logo }}" height="50px" alt="">

                <a href="{{ route('staff.salesman-lead-report') }}">
                    <i class="fa-solid fa-list fa-lg ml-1 mt-4"
                        style="color: #04345d; margin-left: 200px !important; position: relative;
                        top:-76px;"></i>
                </a>
            </div>
        </form>
    </div>

    <form action="{{ route('staff.cashier-lead-list') }}" id="LeadForm" class="mt-2 p-2">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <input type="date" class="form-control item" name="checkin_date_time" id="checkin_date_time"
                        value="{{ app('request')->input('checkin_date_time') ? app('request')->input('checkin_date_time') :date('Y-m-d') }}">
                </div>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-block create-account trigger-btn" style="margin-top: 0">
                    Search
                </button>
            </div>
            <div class="col-md-8">
                {{ date('d-m-Y') }}
            </div>
        </div>
    </form>
    @if ($customers && count($customers) > 0)
        @foreach ($customers as $customer)
            <a href="{{ route('staff.cashier.customer', $customer->id) }}">
                <div class="registration-form">
                    <form style="margin-top: 10px;" action="javascript:void(0);">
                        <main>
                            <div>
                                <div class="accordion__content mt-3">
                                    <div class="row">
                                        <div class="col-12 col-lg-12">
                                            <div class="form-group">
                                                <i class="fa-solid fa-user fa-lg"
                                                    style="color: #04345d; margin-top: -10px;"></i>
                                                <p class="ml-5">Sales Person [ बिक्री कर्मचारी ] : <span
                                                        class="span_text">
                                                        {{ $customer->user ? $customer->user->first_name : '' }}
                                                        {{ $customer->user ? $customer->user->last_name : '' }} </span></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-12">
                                            <div class="form-group">
                                                <i class="fa-solid fa-user fa-lg"
                                                    style="color: #04345d; margin-top: -10px;"></i>
                                                <p class="ml-5">Guide Name [ मार्गदर्शक नाम ] : <span class="span_text">
                                                        {{ $customer->name }} </span></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-12">

                                            <div class="form-group">

                                                <i class="fa-solid fa-taxi fa-lg"
                                                    style="color: #04345d; margin-top: -10px;"></i>
                                                <p class="ml-5">Taxi Num.. [ टैक्सी नंबर ] : <span class="span_text">

                                                        {{ $customer->taxi_number }} </span></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-12">
                                            <div class="form-group">
                                                <i class="fa-solid fa-people-group fa-lg"
                                                    style="color: #04345d; margin-top: -10px;"></i>
                                                <p class="ml-5">Total Member [ कुल सदस्य ] : <span class="span_text">
                                                        {{ $customer->men + $customer->women + $customer->children }}
                                                    </span>

                                                </p>
                                            </div>

                                        </div>
                                        <div class="col-12 col-lg-12">
                                            <div class="form-group">
                                                <i class="fa-solid fa-people-group fa-lg"
                                                    style="color: #04345d; margin-top: -10px;"></i>
                                                <p class="ml-5">पाई <span class="span_text">
                                                        {{ $customer->pai }}
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </form>
                </div>

            </a>
        @endforeach
    @else
        <div class="registration-form">
            <form style="margin-top: 20px;">
                <div class="row text-center">
                    <div class="col-md-12 text-center">
                        <h3> Customers Not Found.</h3>
                    </div>
                </div>
            </form>

        </div>
    @endif

@endsection
@section('scripts')
    <script type="text/javascript">
        setInterval(function() {
            window.location.reload();
        }, 10000);
    </script>
@endsection
