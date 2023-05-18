@extends('layouts.admin')
@section('content')
    <div class="container-fluid" ng-controller="PageController">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Yearly Report
                    </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.customers.yearly-report') }}" method="get">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input type="text" name="mobile" class="form-control" placeholder="Mobile"
                                            value="{{ app('request')->input('mobile') }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Taxi Number</label>
                                        <input type="text" name="taxi_number" class="form-control"
                                            placeholder="Taxi Number" value="{{ app('request')->input('taxi_number') }}">
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
                                        <select name="checkin_date_time" id="checkin_date_time" class="form-control">
                                            <option value="2021-2022">2022-2022</option>
                                            <option value="2022-2023">2022-2023</option>
                                            <option value="2023-2024">2023-2024</option>
                                            <option value="2024-2025">2024-2025</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Search
                                        </button>

                                        <button type="submit" class="btn btn-primary" name="export_pdf"
                                            value="export_pdf">Print</button>
                                    </div>
                                </div>
                                {{-- <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="export_excel"
                                            value="export_excel">Export Excel
                                        </button>
                                    </div>
                                </div> --}}
                            </div>
                        </form>
                        <div class="table-responsive mt-3">
                            <table class="table table-centered datatable dt-responsive nowrap "
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-light">
                                    <tr>
                                        <th rowspan="2">
                                            Month
                                        </th>
                                        <th rowspan="2">
                                            Sale Amount
                                        </th>
                                        <th colspan="3" class="text-center">
                                            Mode Of Paymet
                                        </th>
                                        <th rowspan="2">Commission Amount
                                        </th>
                                        <th rowspan="2">पाई (pai)
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Cash
                                        </th>
                                        <th>Upi
                                        </th>
                                        <th>Card
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($customers) && count($customers) > 0)
                                        @php
                                            $total_amount = 0;
                                            $total_cash_amount = 0;
                                            $total_upi_amount = 0;
                                            $total_card_amount = 0;
                                            $total_commission_amount = 0;
                                            $total_pai_amount = 0;
                                        @endphp
                                        @foreach ($customers as $key => $item)
                                            @php
                                                $total_amount = $total_amount + $item->total_amount;
                                                $total_cash_amount = $total_amount + $item->total_cash_amount;
                                                $total_upi_amount = $total_amount + $item->total_upi_amount;
                                                $total_card_amount = $total_amount + $item->total_card_amount;
                                                $total_commission_amount = $total_amount + $item->total_commission_amount;
                                                $total_pai_amount = $total_pai_amount + $item->total_pai_amount;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <a
                                                        href="{{ route('admin.customers.monthly-report', ['checkin_date_time' => $item->year . '-' . $item->month]) }}">
                                                        {{ date('F', mktime(0, 0, 0, $item->month, 10)) }}-
                                                        {{ $item->year }}
                                                    </a>

                                                </td>
                                                <td>{{ $item->total_amount }}
                                                </td>
                                                <td>{{ $item->total_cash_amount }}
                                                </td>
                                                <td>{{ $item->total_upi_amount }}
                                                </td>
                                                <td>{{ $item->total_card_amount }}
                                                </td>
                                                <td>{{ $item->total_commission_amount }}
                                                </td>
                                                <td>{{ $item->total_pai_amount }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                        <tr>
                                            <td>
                                                Total
                                            </td>
                                            <td>{{ $total_amount }}
                                            </td>
                                            <td>{{ $total_cash_amount }}
                                            </td>
                                            <td>{{ $total_upi_amount }}
                                            </td>
                                            <td>{{ $total_card_amount }}
                                            </td>
                                            <td>{{ $total_commission_amount }}
                                            </td>
                                            <td>{{ $total_pai_amount }}
                                            </td>
                                        </tr>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="11" class="text-center">
                                                <strong>No Data Found </strong>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <hr>
                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>
</div>@endsection
@section('scripts')
    <script type="text/javascript">
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
