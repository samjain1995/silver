@extends('layouts.admin')
@section('content')
    <div class="container-fluid" ng-controller="PageController">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Daily Report
                    </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.customers.daly-report') }}" method="get">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="date" class="form-control" id="checkin_date_time" placeholder="Name"
                                            name="checkin_date_time" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Search
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="export_excel"
                                            value="export_excel">Export Excel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive mt-3">
                            <table class="table table-centered datatable dt-responsive nowrap "
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 20px;" rowspan="2">
                                            <div class="custom-control custom-checkbox">
                                                #
                                            </div>
                                        </th>
                                        <th rowspan="2">
                                            Number
                                        </th>
                                        <th rowspan="2">
                                            P आने का समय
                                        </th>
                                        <th rowspan="2">
                                            Sales Person
                                        </th>
                                        <th rowspan="2">
                                            Bill Number
                                        </th>
                                        <th rowspan="2">
                                            Sale Amount
                                        </th>
                                        <th colspan="3" class="text-center">
                                            Mode Of Paymet
                                        </th>
                                        <th rowspan="2">छबी % (Commission)
                                        </th>
                                        <th rowspan="2">Textile Sale
                                        </th>
                                        <th rowspan="2">Commission
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
                                <tbody> @php
                                    $count = app('request')->input('page') && app('request')->input('page') > 1 ? (app('request')->input('page') - 1) * 50 + 1 : 1;
                                    $total = 0;
                                    $total_cash_amount = 0;
                                    $total_upi_amount = 0;
                                    $total_card_amount = 0;
                                    $total_commission_amount = 0;
                                    $total_pai_amount = 0;
                                @endphp @if (!empty($customers) && count($customers) > 0)
                                        @foreach ($customers as $key => $item)
                                            @php
                                                $total = $total + $item->amount;
                                                $total_cash_amount = $total_cash_amount + $item->cash_amount;
                                                $total_upi_amount = $total_upi_amount + $item->upi_amount;
                                                $total_card_amount = $total_card_amount + $item->card_amount;
                                                $total_commission_amount = $total_commission_amount + $item->commission_amount;
                                                $total_pai_amount = $total_pai_amount + $item->pai;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox"> {{ $count }} </div>
                                                </td>
                                                <td> {{ $item->vehicle }}
                                                    {{ $item->taxi_number ? '(' . $item->taxi_number . ')' : '' }}
                                                </td>
                                                <td>{{ date('d-m-Y H:i:s A', strtotime($item->checkin_date_time)) }}</td>
                                                <td>
                                                    (@if ($item->is_textile == 1)
                                                        सीधा नेशनल
                                                    @endif
                                                    @if ($item->user && $item->user->id != 14)
                                                        {{ $item->user ? $item->user->first_name . ' ' . $item->user->last_name : '-' }}
                                                    @endif)
                                                </td>
                                                <td>{{ $item->bill_number }}
                                                </td>
                                                <td>{{ $item->amount }}
                                                </td>
                                                <td>{{ $item->cash_amount }}
                                                </td>
                                                <td>{{ $item->upi_amount }}
                                                </td>
                                                <td>{{ $item->card_amount }}
                                                </td>
                                                <td>{{ $item->commission }} %
                                                </td>
                                                <td>-</td>
                                                <td>{{ $item->commission_amount }}
                                                </td>
                                                <td>{{ $item->pai }}
                                                </td>
                                            </tr>
                                            @php
                                                $count++;
                                            @endphp
                                        @endforeach
                                        <tr>
                                            <td colspan="5"> Total </td>
                                            <td> {{ $total }} </td>
                                            <td>{{ $total_cash_amount }} </td>
                                            <td>{{ $total_upi_amount }} </td>
                                            <td>{{ $total_card_amount }} </td>
                                            <td>-</td>
                                            <td> 0</td>
                                            <td>{{ $total_commission_amount }} </td>
                                            <td>{{ $total_pai_amount }}</td>
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
                        <div class="mb-2 text-right">
                            {{ $customers->appends(app('request')->input())->links() }}
                        </div>
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
