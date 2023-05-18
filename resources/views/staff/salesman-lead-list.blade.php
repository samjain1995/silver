{{-- <style>

    .adminActions {

        position: fixed;

        bottom: 35px;

        right: 35px;

    }



    .adminButton {

        height: 60px;

        width: 60px;

        background-color: rgba(67, 83, 143, .8);

        border-radius: 50%;

        display: block;

        color: #fff;

        text-align: center;

        /* position: relative; */

        z-index: 1;

    }



    .adminButton i {

        font-size: 25px;

        margin-left: -25px;

        margin-top: -6px;

    }



    .adminButtons {

        position: absolute;

        width: 100%;

        bottom: 120%;

        text-align: center;

    }



    .adminButtons a {

        display: block;

        width: 45px;

        height: 45px;

        border-radius: 50%;

        text-decoration: none;

        margin: 10px auto 0;

        line-height: 1.15;

        color: #fff;

        opacity: 0;

        visibility: hidden;

        position: relative;

        box-shadow: 0 0 5px 1px rgba(51, 51, 51, .3);

    }



    .adminButtons a:hover {

        transform: scale(1.05);

    }

</style> --}}



@extends('layouts.staff')



@section('content')



    {{-- <div class="adminActions">

        <a class="adminButton" href="{{ route('staff.cashier') }}"><i class="fa-solid fa-person-military-pointing"></i></a>

    </div> --}}



    <div class="registration-form">

        <form style="margin-top: 100px;">

            <div class="form-icon_1">

                <img src="{{ getSiteSettings()->company_logo }}" height="50px" alt="">

        

                <a href="{{ route('staff.cashier')}}">

                    <i class="fa-solid fa-user fa-lg mt-3 user_left_section" style="color: #04345d;"></i>

                </a>



                <!-- <a href="{{ route('staff.salesman-lead-report')}}">

                    <i class="fa-solid fa-list fa-lg ml-1 mt-4" style="color: #04345d; padding-left: 70px;"></i>

                </a> -->

            </div>

            <div class="form-icon">



                <a href="{{ route('staff.salesman-lead-report')}}">

                    <i class="fa-solid fa-list fa-lg ml-1 mt-4 section_logo_top sec_top_margin"></i>

                </a>

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

                                                        {{ $customer->user ? $customer->user->last_name : '' }}

                                                    </span>

                                                </p>

                                            </div>

                                        </div>

                                        <div class="col-12 col-lg-12">

                                            <div class="form-group">

                                                <i class="fa-solid fa-user fa-lg"

                                                    style="color: #04345d; margin-top: -10px;">

                                                </i>

                                                <p class="ml-5">लाने वाला : <span class="span_text">

                                                        {{ $customer->vehicle }}

                                                        {{ $customer->taxi_number ? '(' . $customer->taxi_number . ')' : '' }}

                                                    </span>

                                                </p>

                                            </div>

                                        </div>

                                        <div class="col-12 col-lg-12">

                                            <div class="form-group">

                                                <i class="fa-solid fa-user fa-lg"

                                                    style="color: #04345d; margin-top: -10px;">

                                                </i>

                                                <p class="ml-5">लाने वाले का नाम : <span class="span_text">

                                                        {{ $customer->name }} </span>

                                                </p>

                                            </div>

                                        </div>

                                        <div class="col-12 col-lg-12">

                                            <div class="form-group">

                                                <i class="fa-solid fa-taxi fa-lg"

                                                    style="color: #04345d; margin-top: -10px;"></i>

                                                <p class="ml-5">P आने का समय: <span class="span_text">

                                                        {{ date('d-m-Y H:i:s A', strtotime($customer->checkin_date_time)) }}

                                                    </span>

                                                </p>

                                            </div>

                                        </div>

                                        <div class="col-12 col-lg-12">

                                            <div class="form-group">

                                                <i class="fa-solid fa-taxi fa-lg"

                                                    style="color: #04345d; margin-top: -10px;"></i>

                                                <p class="ml-5"> मोबाइल: <span class="span_text">

                                                        {{ $customer->mobile }}

                                                    </span>

                                                </p>

                                            </div>

                                        </div>

                                        <div class="col-12 col-lg-12">

                                            <div class="form-group">

                                                <i class="fa-solid fa-people-group fa-lg"

                                                    style="color: #04345d; margin-top: -10px;"></i>

                                                <p class="ml-5">

                                                    @if ($customer->couple)

                                                        {{ $customer->couple }} कपल

                                                    @endif

                                                    @if ($customer->children)

                                                        + {{ $customer->children }} बच्चे

                                                    @endif

                                                    @if ($customer->men)

                                                        + {{ $customer->men }} पुरुष

                                                    @endif

                                                    @if ($customer->women)

                                                        + {{ $customer->women }} महिला

                                                    @endif

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

                        <h3>P नहीं है |</h3>

                    </div>

                </div>

            </form>

        </div>

    @endif

@endsection

@section('scripts')

    <!-- <script type="text/javascript">

        setInterval(function() {

            window.location.reload();

        }, 10000);

    </script> -->

@endsection

