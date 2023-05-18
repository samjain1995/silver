@extends('layouts.admin')

@section('content')
    <div class="container-fluid" ng-controller="AngularPageController">

        <!-- start page title -->

        <div class="row">

            <div class="col-12">

                <div class="page-title-box d-flex align-items-center justify-content-between">

                    <h4 class="mb-0">Customer</h4>

                </div>

            </div>

        </div>

        <!-- end page title -->

        <div class="row">

            <div class="col-xl-12">

                <div class="card">

                    <div class="card-body">

                        <form class="needs-validation" method="POST"
                            action="{{ route('admin.customers.update', $customer->id) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Sales Person </label>
                                        <select name="vehicle" id="vehicle" class="form-control">
                                            <option value="Taxi" {{ $customer->vehicle == 'Taxi' ? 'selected' : '' }}>Taxi
                                            </option>
                                            <option value="Auto" {{ $customer->vehicle == 'Auto' ? 'selected' : '' }}>Auto
                                            </option>
                                            <option value="Guide" {{ $customer->vehicle == 'Guide' ? 'selected' : '' }}>
                                                Guide </option>
                                            <option value="WC" {{ $customer->vehicle == 'WC' ? 'selected' : '' }}>WC
                                            </option>
                                            <option value="LP" {{ $customer->vehicle == 'LP' ? 'selected' : '' }}>LP
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group">

                                        <label for="name">Sales Person </label>

                                        <select name="sales_person" id="sales_person" class="form-control">

                                            <option value="">Select </option>

                                            @foreach ($salesmans as $item)
                                                <option value="{{ $item->id }}">{{ $item->first_name }}

                                                    {{ $item->last_name }}

                                                </option>
                                            @endforeach

                                        </select>

                                    </div>

                                </div>



                                <div class="col-md-4">

                                    <div class="form-group">

                                        <label for="name">Name</label>

                                        <input type="text" class="form-control" id="name" placeholder="Name"
                                            value="{{ $customer->name }}" name="name" />

                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif

                                    </div>

                                </div>



                                <div class="col-md-4">

                                    <div class="form-group">

                                        <label for="mobile">Mobile</label>

                                        <input type="text" class="form-control" id="mobile" placeholder="Mobile"
                                            value="{{ $customer->mobile }}" name="mobile" />

                                        @if ($errors->has('mobile'))
                                            <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                        @endif

                                    </div>

                                </div>



                                <div class="col-md-4">

                                    <div class="form-group">

                                        <label for="bill_number">Bill Number</label>

                                        <input type="text" class="form-control" id="bill_number"
                                            placeholder="Bill Number" value="{{ $customer->bill_number }}"
                                            name="bill_number" />

                                        @if ($errors->has('bill_number'))
                                            <span class="text-danger">{{ $errors->first('bill_number') }}</span>
                                        @endif

                                    </div>

                                </div>



                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label for="couple">Couple</label>

                                        <input type="number" class="form-control" id="couple" placeholder="Couple"
                                            value="{{ $customer->couple }}" name="couple" />

                                        @if ($errors->has('couple'))
                                            <span class="text-danger">{{ $errors->first('couple') }}</span>
                                        @endif

                                    </div>

                                </div>



                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label for="men">Men</label>

                                        <input type="number" class="form-control" id="men" placeholder="men"
                                            value="{{ $customer->men }}" name="men" />

                                        @if ($errors->has('men'))
                                            <span class="text-danger">{{ $errors->first('men') }}</span>
                                        @endif

                                    </div>

                                </div>



                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label for="women">Women</label>

                                        <input type="number" class="form-control" id="women" placeholder="Women"
                                            value="{{ $customer->women }}" name="women" />

                                        @if ($errors->has('women'))
                                            <span class="text-danger">{{ $errors->first('women') }}</span>
                                        @endif

                                    </div>

                                </div>



                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label for="children">Children</label>

                                        <input type="number" class="form-control" id="children" placeholder="Children"
                                            value="{{ $customer->children }}" name="children" />

                                        @if ($errors->has('children'))
                                            <span class="text-danger">{{ $errors->first('children') }}</span>
                                        @endif

                                    </div>

                                </div>



                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="checkin_date_time">Checkin Date Time<span
                                                class="text-danger">*</span></label>

                                        <input type="datetime-local" class="form-control" id="checkin_date_time"
                                            placeholder="Commission" value="{{ $customer->checkin_date_time }}"
                                            name="checkin_date_time" />

                                        @if ($errors->has('checkin_date_time'))
                                            <span class="text-danger">{{ $errors->first('checkin_date_time') }}</span>
                                        @endif

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="checkout_date_time">Checkout Date Time<span
                                                class="text-danger">*</span></label>

                                        <input type="datetime-local" class="form-control" id="checkout_date_time"
                                            placeholder="Commission" value="{{ $customer->checkout_date_time }}"
                                            name="checkout_date_time" />

                                        @if ($errors->has('checkout_date_time'))
                                            <span class="text-danger">{{ $errors->first('checkout_date_time') }}</span>
                                        @endif

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label for="cash_amount">Cash</label>

                                        <input type="number" class="form-control amount_input" id="cash_amount"
                                            placeholder="Cash" value="{{ $customer->cash_amount }}"
                                            name="cash_amount" />

                                        @if ($errors->has('cash_amount'))
                                            <span class="text-danger">{{ $errors->first('cash_amount') }}</span>
                                        @endif

                                    </div>

                                </div>





                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label for="upi_amount">upi</label>

                                        <input type="number" class="form-control amount_input" id="upi_amount"
                                            placeholder="Upi" value="{{ $customer->upi_amount }}" name="upi_amount" />

                                        @if ($errors->has('upi_amount'))
                                            <span class="text-danger">{{ $errors->first('upi_amount') }}</span>
                                        @endif

                                    </div>

                                </div>



                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label for="card_amount">Card</label>

                                        <input type="number" class="form-control amount_input" id="card_amount"
                                            placeholder="Card" value="{{ $customer->card_amount }}"
                                            name="card_amount" />

                                        @if ($errors->has('card_amount'))
                                            <span class="text-danger">{{ $errors->first('card_amount') }}</span>
                                        @endif

                                    </div>

                                </div>



                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label for="amount">Total Sell</label>

                                        <input type="number" class="form-control" id="amount" placeholder="Card"
                                            value="{{ $customer->amount }}" name="amount" />

                                        @if ($errors->has('amount'))
                                            <span class="text-danger">{{ $errors->first('amount') }}</span>
                                        @endif

                                    </div>

                                </div>



                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label for="commission">Commission</label>

                                        <input type="number" class="form-control" id="commission"
                                            placeholder="Commission" value="{{ $customer->commission }}"
                                            name="commission" />

                                        @if ($errors->has('commission'))
                                            <span class="text-danger">{{ $errors->first('commission') }}</span>
                                        @endif

                                    </div>

                                </div>



                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label for="commission_amount">Commission Amount<span
                                                class="text-danger">*</span></label>

                                        <input type="number" class="form-control" id="commission_amount"
                                            placeholder="Commission Amount" value="{{ $customer->commission_amount }}"
                                            name="commission_amount" />

                                        @if ($errors->has('commission_amount'))
                                            <span class="text-danger">{{ $errors->first('commission_amount') }}</span>
                                        @endif

                                    </div>

                                </div>

                            </div>

                            <button class="btn btn-primary" type="submit">Submit</button>

                        </form>

                    </div>

                </div>

                <!-- end card -->

            </div> <!-- end col -->

        </div>

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

        });



        $(document).on("change", "#commission", function() {

            var commission = $(this).val();

            var total_amount = $('#amount').val();

            if (commission && total_amount) {

                var commission_amount = total_amount * commission / 100;



                $('#commission_amount').val(commission_amount)

            } else {

                $('#commission_amount').val(0);

            }

        });

        app.controller('AngularPageController', function($window, $scope, $location, $http, ngDialog, toaster) {



        });
    </script>
@endsection
