@extends('layouts.staff')
@section('content')
    <div class="registration-form">
        <form style="margin-top: 100px;">
            <div class="form-icon">
                <img src="{{ getSiteSettings()->company_logo }}" height="50px" alt="">

                <!-- <span><i class="icon icon-user"></i></span> -->
            </div>
        </form>
    </div>
    @if ($customers && count($customers) > 0)
        @foreach ($customers as $customer)
            <a href="{{ route('staff.salesman.customer', $customer->id) }}">
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
