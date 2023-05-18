@extends('layouts.staff')

@section('content')
    <div class="registration-form">

        <form style="margin-top: 100px;" id="customer_form">
            <div class="form-icon">
                <img src="{{ getSiteSettings()->company_logo }}" height="50px" alt="">
                <!-- <span><i class="icon icon-user"></i></span> -->
            </div>
            <main>
                <div>
                    <div class="accordion__content mt-3">
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <i class="fa-solid fa-user fa-lg" style="color: #04345d; margin-top: -10px;"></i>
                                    <p class="ml-5">Sales Person [ बिक्री कर्मचारी ] : <span class="span_text">
                                            {{ $customer->user ? $customer->user->first_name : '' }}
                                            {{ $customer->user ? $customer->user->last_name : '' }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <i class="fa-solid fa-user fa-lg" style="color: #04345d; margin-top: -10px;"></i>
                                    <p class="ml-5">लाने वाला : <span class="span_text">{{ $customer->vehicle }}
                                            {{ $customer->taxi_number ? '(' . $customer->taxi_number . ')' : '' }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <i class="fa-solid fa-user fa-lg" style="color: #04345d; margin-top: -10px;"></i>
                                    <p class="ml-5">लाने वाले का नाम :
                                        <span class="span_text">{{ $customer->name }} </span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <i class="fa-solid fa-taxi fa-lg" style="color: #04345d; margin-top: -10px;"></i>
                                    <p class="ml-5">Taxi Num.. [ टैक्सी नंबर ] : <span class="span_text">
                                            {{ $customer->taxi_number }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <i class="fa-solid fa-people-group fa-lg"
                                        style="color: #04345d; margin-top: -10px;"></i>
                                    <p class="ml-5">Total Member [ कुल सदस्य ] :
                                        <span class="span_text">
                                            {{ $customer->men + $customer->women + $customer->children }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <i class="fa-solid fa-people-group fa-lg"
                                        style="color: #04345d; margin-top: -10px;"></i>
                                    <p class="ml-5">Total [ कुल ] :
                                        <span class="span_text">
                                            {{ $customer->amount }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <i class="fa-solid fa-people-group fa-lg"
                                        style="color: #04345d; margin-top: -10px;"></i>
                                    <p class="ml-5">(छबी %) :
                                        <span class="span_text">
                                            {{ $customer->commission }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <i class="fa-solid fa-people-group fa-lg"
                                        style="color: #04345d; margin-top: -10px;"></i>
                                    <p class="ml-5">Commission Amount:
                                        <span class="span_text">
                                            {{ $customer->commission_amount }}
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
                        {{-- <div class="row">
                            <input type="hidden" name="customer_id" id="customer_id" value="{{ $customer->id }}">
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <i class=" fa-lg ml-1" style="color: #04345d; font-weight: 800;">कमीशन</i>
                                    <input type="number" name="commission_amount" id="total_amount"
                                        class="form-control item" style="padding-left: 100px;"
                                        placeholder="Amount [ कुल कमीशन ]" value="0">
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </main>
            {{-- <div class="form-group" style="margin-bottom: 35px;">
                <a href="javascript:void(0);" class="btn btn-block create-account" onclick="SubmitDetails()">
                    Submit (भरी)
                </a>
            </div> --}}
        </form>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).on("change", ".amount_input", function() {
            var amount = 0;
            $('.amount_input').each(function(index, value) {
                if ($(this).val()) {
                    amount = amount + parseInt($(this).val());
                }
            });
            $('#amount').val(amount);
            $('#total_amount').val(amount);
        });

        function SubmitDetails() {
            callPostAjax("{{ route('staff.cashier.customer-update') }}", "#customer_form", 0, 1,
                "{{ route('staff.cashier-lead-list') }}");
        }

        function SubmitNoSele() {
            return;
            $.ajax({

                url: '{{ route('staff.salesman.no-sell-update') }}',

                headers: {

                    'X-CSRF-TOKEN': '{{ csrf_token() }}'

                },

                method: 'post',

                data: new FormData($("#customer_form")[0]),

                beforeSend: function() {

                    $("#preloader").show();

                },

                cache: false,

                contentType: false,

                processData: false,

                success: function(response) {

                    $('#preloader').hide();

                    window.location.href = '{{ route('staff.salesman-lead-list') }}';

                }

            });

        }
    </script>
@endsection
