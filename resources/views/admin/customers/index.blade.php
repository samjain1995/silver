@extends('layouts.admin')
@section('content')
    <div class="container-fluid" ng-controller="PageController">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">roles</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div id="search-collapse-accordion" class="custom-accordion-arrow">
                    <div class="card">
                        <a href="#search-collapse" class="collapsed" data-toggle="collapse"
                            aria-expanded="{{ count(app('request')->all()) > 0 ? 'true' : 'false' }}"
                            aria-controls="search-collapse">
                            <div class="card-header" id="search-collapse-heading">
                                <h5 class="font-size-14 m-0">
                                    <i class="mdi mdi-chevron-up accor-arrow-icon"></i> Search
                                </h5>
                            </div>
                        </a>
                        <div id="search-collapse" class="collapse {{ count(app('request')->all()) > 0 ? 'show' : '' }}"
                            aria-labelledby="search-collapse-heading" data-parent="#search-collapse-accordion">
                            <div class="card-body">
                                <form action="{{ route('admin.customers.index') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="name" class="form-control" placeholder="Name"
                                                    value="{{ app('request')->input('name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Mobile</label>
                                                <input type="text" name="mobile" class="form-control"
                                                    placeholder="Mobile" value="{{ app('request')->input('mobile') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Taxi Number</label>
                                                <input type="text" name="taxi_number" class="form-control"
                                                    placeholder="Taxi Number"
                                                    value="{{ app('request')->input('taxi_number') }}">
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Sales Person</label>
                                                <select class="form-control select2" name="sales_person">
                                                    <option value="">Select</option>
                                                    @if ($users && count($users) > 0)
                                                        @foreach ($users as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ app('request')->input('sales_person') == $item->id ? 'selected' : '' }}>
                                                                {{ $item->first_name }} {{ $item->last_name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="mb-3">
                                                    <label class="form-label">Payment Mode<span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="payment_mode">
                                                        <option value="">Select</option>
                                                        <option value="Cash"
                                                            {{ app('request')->input('payment_mode') == 'Cash' ? 'selected' : '' }}>
                                                            Cash
                                                        </option>
                                                        <option value="UPI"
                                                            {{ app('request')->input('payment_mode') == 'UPI' ? 'selected' : '' }}>
                                                            UPI
                                                        </option>

                                                        <option value="Cheque"
                                                            {{ app('request')->input('payment_mode') == 'Cheque' ? 'selected' : '' }}>
                                                            Cheque
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="mb-3">
                                                    <label class="form-label">Sell<span class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="is_sell">
                                                        <option value="">All</option>
                                                        <option value="Yes"
                                                            {{ app('request')->input('is_sell') == 'Yes' ? 'selected' : '' }}>
                                                            Yes
                                                        </option>
                                                        <option value="No"
                                                            {{ app('request')->input('is_sell') == 'No' ? 'selected' : '' }}>
                                                            No
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Bill amount</label>
                                                <input type="text" name="amount" class="form-control"
                                                    placeholder="Bill amount"
                                                    value="{{ app('request')->input('amount') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Bill Number</label>
                                                <input type="text" name="bill_number" class="form-control"
                                                    placeholder="Bill Number"
                                                    value="{{ app('request')->input('bill_number') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>From Date</label>
                                                <input type="date" name="from_date" class="form-control"
                                                    placeholder="Bill Number"
                                                    value="{{ app('request')->input('from_date') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>To Date</label>
                                                <input type="date" name="to_date" class="form-control"
                                                    placeholder="Bill Number"
                                                    value="{{ app('request')->input('to_date') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                                <a href="{{ route('admin.customers.index') }}"
                                                    class="btn btn-danger waves-effect waves-light">Clear</a>
                                                <button type="submit" class="btn btn-primary" name="export_excel"
                                                    value="export_excel">Export Excel</button>

                                                <button type="submit" class="btn btn-primary" name="export_pdf"
                                                    value="export_pdf">Print</button>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="month" class="form-control" id="checkin_date_time"
                                                    placeholder="Name" name="checkin_date_time" />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary" id="bulk_delete">bulk
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table table-centered datatable dt-responsive nowrap "
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="custom-control custom-checkbox">
                                                #
                                            </div>
                                        </th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Taxi Number</th>
                                        <th>Vehicle</th>
                                        <th>Stay Time</th>
                                        <th>Sales Person</th>
                                        <th>Payment Mode</th>
                                        <th>Bill Amount</th>
                                        <th>Bill Number</th>
                                        <th>Checkin Date Time</th>
                                        <th>Checkout Date Time</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = app('request')->input('page') && app('request')->input('page') > 1 ? (app('request')->input('page') - 1) * 50 + 1 : 1;
                                    @endphp

                                    @if (!empty($customers) && count($customers) > 0)
                                        @foreach ($customers as $key => $item)
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        {{ $count }}
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $item->name }}
                                                </td>
                                                <td>{{ $item->mobile }}</td>
                                                <td>{{ $item->taxi_number }}</td>
                                                <td>{{ $item->vehicle }}</td>
                                                <td>{{ $item->getStayTimeAttribute($item->checkin_date_time, $item->checkout_date_time) }}
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0);"
                                                        ng-click="showCustomer({{ $key }})">
                                                        (@if ($item->is_textile == 1)
                                                            सीधा नेशनल
                                                        @endif
                                                        @if ($item->user && $item->user->id != 14)
                                                            {{ $item->user ? $item->user->first_name . ' ' . $item->user->last_name : '-' }}
                                                        @endif)
                                                    </a>

                                                </td>
                                                <td>{{ $item->payment_mode }}</td>
                                                <td>{{ $item->amount }}</td>
                                                <td>{{ $item->bill_number }}</td>
                                                <td>
                                                    {{ date('d-m-Y H:i:s A', strtotime($item->checkin_date_time)) }}
                                                </td>
                                                <td>
                                                    @if ($item->checkout_date_time)
                                                        {{ date('d-m-Y H:i:s A', strtotime($item->checkout_date_time)) }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ date('d-m-Y', strtotime($item->created_at)) }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.customers.edit', $item->id) }}"
                                                        class="btn btn-outline-dark btn-sm waves-effect waves-light row-edit-button">
                                                        <i class="ri-edit-box-line font-size-18"></i>
                                                    </a>
                                                    <button
                                                        class="btn btn-outline-danger btn-sm waves-effect waves-light row-delete-button"
                                                        delete-url="{{ route('admin.customers.delete', $item->id) }}">
                                                        <i class="mdi mdi-trash-can font-size-18"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @php
                                                $count++;
                                            @endphp
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="11" class="text-center">
                                                <strong>No Data Found</strong>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="mb-2 text-right">
                            {{ $customers->appends(app('request')->input())->links() }}
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).on('click', '#bulk_delete', function(event) {
            var month = $('#checkin_date_time').val();

            var delete_url = '{{ route('admin.customers.bulk-delete') }}';
            event.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: "Are You Sure You Want To Delete This... ?",
                showCancelButton: true,
                confirmButtonColor: '#ff0a36',
                confirmButtonText: `Yes, delete it!`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: delete_url,
                        type: "delete",
                        cache: false,
                        data: {
                            _token: '{{ csrf_token() }}',
                            month: month
                        },
                        success: function(data) {
                            if (data.status == true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: data.message,
                                }).then((value) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: data.message,
                                });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert(errorThrown);
                        }
                    });
                }
            });
        })


        app.controller('PageController', function($window, $scope, $location, $http, ngDialog, toaster) {
            $scope.customers = @json($customers);
            $scope.customers = $scope.customers.data;
            $scope.customer = {};
            $scope.showCustomer = function(key) {
                ngDialog.open({
                    template: '{{ route('admin.customers.show') }}',
                    scope: $scope,
                    overlay: true,
                    closeByEscape: true,
                    closeByDocument: false,
                });

                $scope.customer = $scope.customers[key];
            }
            $scope.EditRole = function(url) {
                ngDialog.open({
                    template: url,
                    scope: $scope,
                    overlay: true,
                    closeByEscape: true,
                    closeByDocument: false,
                });
            }
        });
    </script>
@endsection
