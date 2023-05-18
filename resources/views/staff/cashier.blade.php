@extends('layouts.staff')

@section('content')

    <div class="registration-form">

        <form style="margin-top: 100px;">

            <div class="form-icon_12">

                <img src="{{ getSiteSettings()->company_logo }}" height="50px" alt="">

                <!-- <span><i class="icon icon-user"></i></span> -->

            </div>

        </form>



    </div>



    <div class="registration-form" id="page_section">



        <form style="margin-top: 10px;" action="javascript:void(0);">

            <main>

                <div>

                    <div class="accordion__content mt-3">

                        <div class="row">

                            <div class="col-md-12">

                                <input type="hidden" name="customer_id" id="customer_id">

                                <div class="form-group">

                                    <i class="fa-solid fa-taxi fa-lg ml-1" style="color: #04345d;"></i>

                                    <input type="text" class="form-control item" name="taxi_number" id="taxi_number"

                                        style="padding-left: 40px;" placeholder="Taxi Number [ टैक्सी नंबर ]">

                                </div>

                            </div>

                        </div>

                        <div class="row" id="otp_section" style="display:none">

                            <div class="col-md-8 mt-3">

                                <div class="form-group">

                                    <i class="fa-solid fa-taxi fa-lg ml-1" style="color: #04345d;"></i>

                                    <input type="number" class="form-control item" name="mobile_number" id="mobile_number"

                                        style="padding-left: 40px;" placeholder="Mobile Number">

                                    <span class="text-danger error-span pt-2" id="error_mobile_number"></span>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <button type="button" class="btn btn-block create-account trigger-btn" onclick="SendOtp()">

                                    Send OTP

                                </button>

                            </div>

                            <hr>



                            <div class="col-md-8 mt-3">

                                <div class="form-group">

                                    <i class="fa-solid fa-taxi fa-lg ml-1" style="color: #04345d;"></i>

                                    <input type="number" class="form-control item" name="otp" id="otp"

                                        style="padding-left: 40px;" placeholder="Enter Otp">

                                    <span class="text-danger error-span pt-2" id="error_otp"></span>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <button type="button" class="btn btn-block create-account trigger-btn"

                                    onclick=" VarifyOtp()">

                                    Verify OTP

                                </button>

                            </div>

                        </div>



                    </div>

                </div>

            </main>

        </form>

        <form id="commission_form" class="mt-2">

            <div class="row" id="commission_table_section" style="display:none">

            </div>

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

                        if (response.status == true) {

                            const data = response.data;

                            if (data) {

                                $('#customer_id').val(data.id);

                                $('#otp_section').show();

                                $('#mobile_number').val(data.mobile)

                            } else {

                                $('#otp_section').hide();

                                toastr.error('Error', "No Commission Due  in this Texi.", {

                                    timeOut: 5000

                                });

                            }

                        } else {

                            $('#otp_section').hide();

                            toastr.error('Error', response.message, {

                                timeOut: 5000

                            });

                        }

                    }

                });

            }

        })



        function SendOtp() {

            var mobile = $('#mobile_number').val();

            if (!mobile) {

                toastr.error('Error', "Pls Enter Mobile Number ", {

                    timeOut: 5000

                });

                return false;

            }



            $.ajax({

                url: '{{ route('staff.get-otp') }}',

                headers: {

                    'X-CSRF-TOKEN': '{{ csrf_token() }}'

                },

                method: 'post',

                data: {

                    "mobile": mobile

                },

                beforeSend: function() {

                    $("#preloader").show();

                },

                cache: false,

                success: function(response) {

                    $('#preloader').hide();

                    if (response.status == true) {

                        toastr.success('success', response.message, {

                            timeOut: 5000

                        });

                    } else {

                        $('#otp_section').hide();

                        toastr.error('Error', response.message, {

                            timeOut: 5000

                        });

                    }

                }

            });

        }





        function VarifyOtp() {

            var otp = $("#otp").val();

            if (!otp) {

                toastr.error('Error', "Pls Enter OTP ", {

                    timeOut: 5000

                });

                return false;

            }



            $.ajax({

                url: '{{ route('staff.VarifyOtp') }}',

                headers: {

                    'X-CSRF-TOKEN': '{{ csrf_token() }}'

                },

                method: 'post',

                data: {

                    "otp": otp,

                    "taxi_number": $('#taxi_number').val()

                },

                beforeSend: function() {

                    $("#preloader").show();

                },

                cache: false,

                success: function(response) {

                    $('#preloader').hide();

                    if (response.status == true) {

                        $('#otp_section').hide();

                        $('#commission_table_section').html(response.html);

                        $('#commission_table_section').show();

                        toastr.success('success', response.message, {

                            timeOut: 5000

                        });

                    } else {

                        toastr.error('Error', response.message, {

                            timeOut: 5000

                        });

                    }

                }

            });

        }



        $(document).on('change', '.commission', function(event) {

            var commission = 0;

            $(".commission").each(function() {

                if ($(this).val()) {

                    commission = commission + parseInt($(this).val());

                }

            });

            $('#commission_amount').text(commission);

        })



        function SubmitDetails() {

            var formData = $("#commission_form")[0];

            console.log(formData);

            $.ajax({

                url: '{{ route('staff.update-customer-commission') }}',

                headers: {

                    'X-CSRF-TOKEN': '{{ csrf_token() }}'

                },

                method: 'post',

                beforeSend: function() {

                    $("#preloader").show();

                },

                data: new FormData(formData),

                contentType: false,

                cache: false,

                processData: false,

                success: function(response) {

                    $('#preloader').hide();

                    if (response.status == true) {

                        window.location.reload();

                    } else {

                        toastr.error('Error', response.message, {

                            timeOut: 5000

                        });

                    }

                }

            });



        }

    </script>

@endsection

