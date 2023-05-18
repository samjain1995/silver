@extends('layouts.staff')

@section('content')
    <div class="registration-form">

        <form style="margin-top: 100px;" id="customer_form">
            <div class="form-icon">
                <img src="{{ getSiteSettings()->company_logo }}" height="50px" alt="">
            </div>
            <main>
                <div>
                    <details class="accordion form-control item" open>
                        <summary class="accordion__title">
                            Bill [ बिल ]
                        </summary>
                        <div class="accordion__content mt-3">
                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <i class="fa-solid fa-user fa-lg" style="color: #04345d; margin-top: -10px;"></i>
                                        <p class="ml-5">Sales Person [ बिक्री कर्मचारी ] : <span class="span_text">
                                                {{ $customer->user ? $customer->user->first_name : '' }}
                                                {{ $customer->user ? $customer->user->last_name : '' }}</span>
                                            @if ($customer->sales_person == 14)
                                                <div class="col-md-12">
                                                    <div class="select-wrap one-third ml-2">
                                                        <select name="sales_person" id="sales_person"
                                                            class="form-control members-input">
                                                            <option value="">Select Salesman </option>
                                                            @foreach ($salesmans as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif

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
                                            <span class="span_text">{{ $customer->name }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <i class="fa-solid fa-taxi fa-lg" style="color: #04345d; margin-top: -10px;"></i>
                                        <p class="ml-5">P आने का समय: <span class="span_text">
                                                {{ date('d-m-Y H:i:s A', strtotime($customer->checkin_date_time)) }}
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
                            </div>
                            <div class="row">
                                <input type="hidden" name="customer_id" id="customer_id" value="{{ $customer->id }}">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <i class="fa-solid fa-file-circle-plus fa-lg ml-1" style="color: #04345d;"></i>
                                        <input type="text" class="form-control item" name="bill_number" id="bill_number"
                                            style="padding-left: 40px;" placeholder="Bill Number [ बिल संख्या ]" required>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <i class=" fa-lg ml-1 pa" style="color: #04345d;  font-weight: 800;">कैश</i>
                                        <input type="number" name="cash_amount" id="cash_amount"
                                            class="form-control item amount_input" style="padding-left: 60px;"
                                            placeholder="Cash Amount [ नकद रकम ]" value="0">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <i class=" fa-lg ml-1" style="color: #04345d;  font-weight: 800;">यूपीआई</i>
                                        <input type="number" name="upi_amount" id="upi_amount"
                                            class="form-control item amount_input" style="padding-left: 90px;"
                                            placeholder="UPI Amount [ UPI रकम ]" value="0">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <i class=" fa-lg ml-1" style="color: #04345d;  font-weight: 800;">(कार्ड)</i>
                                        <input type="number" name="card_amount" id="card_amount"
                                            class="form-control item amount_input" style="padding-left: 70px;"
                                            placeholder="Card Amount [ कार्ड रकम ]" value="0">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12">
                                    <input type="hidden" name="amount" id="amount" value="0">
                                    <div class="form-group">
                                        <i class=" fa-lg ml-1" style="color: #04345d; font-weight: 800;">कुल</i>
                                        <input type="number" name="total_amount" id="total_amount"
                                            class="form-control item" style="padding-left: 60px;"
                                            placeholder="Amount [ रकम ]" value="0" disabled>
                                    </div>
                                </div>
                                @if ($customer->vehicle != 'WC' && $customer->vehicle != 'LP')
                                    <div class="col-12 col-lg-12 m-1">
                                        <div class="form-group">
                                            <i class=" fa-lg ml-1" style="color: #04345d; font-weight: 800;">छबी (%)</i>
                                            <input type="number" name="commission" id="commission"
                                                class="form-control item" style="padding-left: 100px;"
                                                placeholder="[ छबी ](%)/ (Commission)" value="30">
                                        </div>
                                    </div>
                                @endif
                                @if ($customer->vehicle != 'LP')
                                    <div class="col-12 col-lg-12 m-1">
                                        <div class="form-group">
                                            <i class=" fa-lg ml-1" style="color: #04345d; font-weight: 800;">पाई</i>
                                            <input type="number" name="pai" id="pai"
                                                class="form-control item" style="padding-left: 100px;"
                                                placeholder="[ पाई ]/(pai)" value="0">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </details>
                </div>
            </main>
            <div class="form-group" style="margin-bottom: 35px;">
                <a href="javascript:void(0);" class="btn btn-block create-account" onclick="SubmitDetails()">Submit (भरी)
                    </button>
                </a>
                <a href="javascript:void(0);" class="btn btn-block create-account" onclick="SubmitNoSele()">No Sell (नहीं
                    भरी)</button>
                </a>
            </div>
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
            callPostAjax("{{ route('staff.salesman.customer-update') }}", "#customer_form", 0, 1,
                "{{ route('staff.salesman-lead-list') }}");
        }

        function SubmitNoSele() {
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
