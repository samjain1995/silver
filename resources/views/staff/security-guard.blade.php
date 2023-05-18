@extends('layouts.staff')

@section('content')

    <div class="registration-form mt-3">

        <form action="javascript:void(0);" id="LeadForm">

            <div class="form-icon">

                <img src="{{ getSiteSettings()->company_logo }}" height="50px" alt="">

                <a href="{{ route('staff.security-guard-daly-report') }}">

                    <i class="fa-solid fa-user fa-lg ml-1 mt-4" style="color: #04345d;"></i>

                </a>

            </div>

            <fieldset id="setB" class="form-control item ">

                <input id="Taxi" type="radio" class="ml-3 vehicle" name="vehicle" value="Taxi" checked>

                <label for="Taxi">Taxi [ टैक्सी ]</label>

                <input id="Auto" type="radio" class="vehicle" style="margin-left: 52px;" name="vehicle"
                    value="Auto">

                <label for="Auto">Auto [ ऑटो ]</label><br>

                <input id="Guide" type="radio" class=" ml-3 vehicle" name="vehicle" value="Guide">

                <label for="Guide">Guide [ मार्गदर्शक ]</label>

                <input id="wc" type="radio" class=" ml-2 vehicle" name="vehicle" value="WC">

                <label for="wc" class="mr-2">WC</label>

                <input id="LP" type="radio" class=" ml-1 vehicle" name="vehicle" value="LP">

                <label for="LP">LP</label>

                <span class="text-danger error-span pt-2" id="error_vehicle"></span>

            </fieldset>



            <div class="form-group" id="taxi_number_div">

                <i class="fa-solid fa-taxi fa-lg ml-1" style="color: #04345d;"></i>

                <input type="number" class="form-control item" name="taxi_number" id="taxi_number"
                    style="padding-left: 40px;" placeholder="Taxi Number [ टैक्सी नंबर ]" required>

                <span class="text-danger error-span pt-2" id="error_taxi_number"></span>

            </div>





            <div class="form-group">

                <i class="fa-solid fa-mobile-screen-button fa-lg ml-2" style="color: #04345d;"></i>

                <input type="number" class="form-control item mobileautocomplete" name="mobile"
                    style="padding-left: 40px;" placeholder="Mobile Number [ मोबाइल नंबर ]"
                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">

                <span class="text-danger error-span pt-2" id="error_mobile"></span>

            </div>

            <fieldset>

                <div class="select-wrap mt-1 mb-2">

                    <select name="sales_person" id="sales_person" class="form-control" required>

                        <option value="">Sales Person [ बिक्री कर्मचारी ]</option>

                        @if ($salesmans && count($salesmans))
                            @foreach ($salesmans as $salesman)
                                <option value="{{ $salesman->id }}">{{ $salesman->first_name }} {{ $salesman->last_name }}

                                </option>
                            @endforeach
                        @endif

                    </select>

                </div>

                <span class="text-danger error-span pt-2" id="error_sales_person"></span>

            </fieldset>

            <div class="form-group">

                <i class="fa-solid fa-user fa-lg ml-1" style="color: #04345d;"></i>

                <input type="text" class="form-control item" name="name" id="name_input" style="padding-left: 40px;"
                    placeholder="Name [ नाम ]">

                <span class="text-danger error-span pt-2" id="error_name"></span>

            </div>

            <fieldset id="setB" class="form-control item second mobile-hidden members-input-div">

                <span class="mt-1">Member List : </span>

                <div class="select-wrap one-third ml-2">

                    <select name="couple" id="couple" class="form-control members-input">



                        <option value="">Couple [ कपल ] </option>

                        @for ($i = 1; $i < 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor

                        <option value="">10+</option>

                    </select>

                </div>

                <div class="select-wrap one-third ml-2">

                    <select name="men" id="men" class="form-control members-input">

                        <option value="">Men [ पुरुष ] </option>

                        @for ($i = 1; $i < 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor

                        <option value="">10+</option>

                    </select>

                </div>

                <div class="select-wrap one-third ml-1">

                    <select name="women" id="women" class="form-control members-input">

                        <option value="">Women [ औरत ]</option>

                        @for ($i = 1; $i < 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor

                        <option value="">10+</option>

                    </select>

                </div>

                <div class="select-wrap one-second ml-1">

                    <select name="children" id="children" class="form-control members-input">

                        <option value="">Children [ बच्चे ]</option>

                        @for ($i = 1; $i < 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor

                        <option value="">10+</option>

                    </select>

                </div>

            </fieldset>

            <span class="text-danger error-span pt-2" id="error_members"></span>

            <fieldset class="form-control item">

                <div class="field image d-flex">

                    <img src="{{ asset('frontend/N07PSkAAAAASUVORK5CYII.webp') }}" height="25px" alt="">

                    <input class="ml-3" type="file">

                </div>

            </fieldset>

            <div class="form-group" style="margin-bottom: 18px;">

                <button type="button" class="btn btn-block create-account trigger-btn" onclick="SubmitDetails()">

                    Submit Details

                </button>

            </div>

        </form>

    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>





    <script type="text/javascript">
        $(document).on('click', '.vehicle', function(event) {

            if ($(this).val() == 'Self' || $(this).val() == 'Guide' || $(this).val() == 'WC' || $(this).val() ==

                'LP') {

                $('#taxi_number_div').hide();

                $("#taxi_number").prop('required', false);

            } else {

                $('#taxi_number_div').show();

                $("#taxi_number").prop('required', true);

            }



        })



        function SubmitDetails() {
            $('.create-account')..prop('disabled', true);
            if (memberInputValidationCheck()) {

                callPostAjax("{{ route('staff.customers.store') }}", "#LeadForm", 0);
                $('.create-account')..prop('disabled', false);
            } else {
                $('.create-account')..prop('disabled', false);
            }

        }



        function memberInputValidationCheck() {

            return true;

            $('#error_members').text()

            $('.members-input-div').removeClass('is-invalid');

            var members = 0;

            $('.members-input').each(function(index, value) {

                if ($(this).val()) {

                    members = members + parseInt($(this).val());

                }

            });

            if (members == 0) {

                $('.members-input-div').addClass('is-invalid');

                $('#error_members').text('The member field is required.')

                return false;

            } else {

                return true;

            }

        }



        $('input.mobileautocomplete').typeahead({

            source: function(query, process) {

                return $.get('{{ route('staff.customer.mobile-autocomplete') }}', {

                    query: query,

                    filter: "mobile"

                }, function(data) {

                    return process(data);

                });

            },

            updater: function(item) {

                $("#taxi_number").val(item.taxi_number);

                $("#name_input").val(item.name);

                return item;

            }

        });
    </script>
@endsection
