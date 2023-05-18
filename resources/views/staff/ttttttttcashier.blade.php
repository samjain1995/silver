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

    <div class="registration-form">

        <form style="margin-top: 10px;" action="javascript:void(0);">

            <main>

                <div>

                    <div class="accordion__content mt-3">

                        <div class="row">

                            <div class="col-md-12">

                                <div class="form-group">

                                    <i class="fa-solid fa-taxi fa-lg ml-1" style="color: #04345d;"></i>

                                    <input type="text" class="form-control item" name="taxi_number" id="taxi_number"
                                        style="padding-left: 40px;" placeholder="Taxi Number [ टैक्सी नंबर ]">

                                </div>

                            </div>

                        </div>

                        <div class="row" style="display:none" id="otp_section_div">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <i class="fa-solid fa-user fa-lg" style="color: #04345d; margin-top: -10px;"></i>
                                        <input type="number" class="form-control item" name="otp" id="otp"
                                            style="padding-left: 40px;" placeholder="OTP">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="display:none" id="commission_table_div">
                        </div>



                        <div class="row" style="display:none">

                            <div class="col-12 col-lg-12">

                                <div class="form-group">

                                    <i class="fa-solid fa-user fa-lg" style="color: #04345d; margin-top: -10px;"></i>

                                    <p class="ml-5">Sales Person [ बिक्री कर्मचारी ] : <span class="span_text"
                                            id="sales_person_text"> </span></p>

                                </div>

                            </div>

                            <div class="col-12 col-lg-12">

                                <div class="form-group">

                                    <i class="fa-solid fa-user fa-lg" style="color: #04345d; margin-top: -10px;"></i>

                                    <p class="ml-5">Guide Name [ मार्गदर्शक नाम ] : <span class="span_text"
                                            id="guide_name_text">

                                        </span></p>

                                </div>

                            </div>

                            <div class="col-12 col-lg-12">

                                <div class="form-group">

                                    <i class="fa-solid fa-people-group fa-lg"
                                        style="color: #04345d; margin-top: -10px;"></i>

                                    <p class="ml-5">Total Member [ कुल सदस्य ] : <span class="span_text"
                                            id="total_member_text">

                                        </span>

                                    </p>



                                </div>



                            </div>



                            <div class="col-12 col-lg-12">

                                <div class="form-group">

                                    <i class="fa-solid fa-people-group fa-lg"
                                        style="color: #04345d; margin-top: -10px;"></i>

                                    <p class="ml-5">Total Sell Amount : <span class="span_text"
                                            id="total_sell_amoun_text">

                                        </span>

                                    </p>



                                </div>



                            </div>



                            <div class="col-md-12 mt-3">

                                <div class="form-group">

                                    <input type="hidden" name="customer_id" id="customer_id">

                                    <i class="fa-solid fa-taxi fa-lg ml-1" style="color: #04345d;"></i>

                                    <input type="text" class="form-control item" name="commission_amount"
                                        id="commission_amount" style="padding-left: 40px;" placeholder="Commission Amount">

                                    <span class="text-danger error-span pt-2" id="error_commission_amount"></span>

                                </div>

                                <button type="button" class="btn btn-block create-account trigger-btn"
                                    onclick="SubmitDetails()">

                                    Submit Details

                                </button>

                            </div>



                        </div>



                    </div>



                </div>



            </main>



        </form>



    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).on('change', '#taxi_number', function(event) {

            if ($(this).val()) {

                $.ajax({

                    url: '{{ route('staff.customer-by-texi') }}',

                    headers: {

                        'X-CSRF-TOKEN': '{{ csrf_token() }}'

                    },

                    method: 'post',

                    data: {

                        "taxi_number": $(this).val()

                    },

                    beforeSend: function() {

                        $("#preloader").show();

                    },

                    cache: false,

                    success: function(response) {

                        $('#preloader').hide();

                        //
                        
                        if (response.status == true) {
                            if (response.customers_count > 0) {

                            }
                            $('#info_div').show();

                            const data = response.data;

                            $('#customer_id').val(data.id);

                            if (data.user) {

                                $('#sales_person_text').text(data.user.first_name + " " + data.user

                                    .last_name);

                            }

                            $('#guide_name_text').text(data.name);

                            $('#total_member_text').text(data.men + data.children + data.women);

                            $('#total_sell_amoun_text').text("₹" + data.amount);



                        } else {

                            $('#info_div').hide();

                        }

                    }

                });

            }

        })



        function SubmitDetails() {

            const commission_amount = $('#commission_amount').val();

            if (commission_amount) {

                $.ajax({

                    url: '{{ route('staff.update-customer-commission') }}',

                    headers: {

                        'X-CSRF-TOKEN': '{{ csrf_token() }}'

                    },

                    method: 'post',

                    data: {

                        customer_id: $('#customer_id').val(),

                        commission_amount: $('#commission_amount').val()

                    },

                    beforeSend: function() {

                        $("#preloader").show();

                    },

                    cache: false,

                    success: function(response) {

                        $('#preloader').hide();

                        //

                        if (response.status == true) {

                            window.location.reload();

                        } else {

                            toastr.error('Error', response.message, {

                                timeOut: 5000

                            });

                        }

                    }

                });

            } else {

                $('#error_commission_amount').text('Commission Amount is  Required.')

            }

        }
    </script>
@endsection
