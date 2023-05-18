@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">Total Customers</p>
                                        <h4 class="mb-0" id="total_customers">0</h4>
                                    </div>
                                    <div class="text-primary">
                                        <i class="ri-stack-line font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">Today Customers</p>
                                        <h4 class="mb-0" id="today_customers">0</h4>
                                    </div>
                                    <div class="text-primary">
                                        <i class="ri-store-2-line font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">Today Sale</p>
                                        <h4 class="mb-0" id="today_sale">0</h4>
                                    </div>
                                    <div class="text-primary">
                                        <i class="ri-briefcase-4-line font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">Total Sale</p>
                                        <h4 class="mb-0" id="total_sale">0</h4>
                                    </div>
                                    <div class="text-primary">
                                        <i class="ri-briefcase-4-line font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">Today amount of cash collection </p>
                                        <h4 class="mb-0" id="today_cash_amount">0</h4>
                                    </div>
                                    <div class="text-primary">
                                        <i class="ri-briefcase-4-line font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">Today amount of upi collection</p>
                                        <h4 class="mb-0" id="today_upi_amount">0</h4>
                                    </div>
                                    <div class="text-primary">
                                        <i class="ri-briefcase-4-line font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">Today amount of card collection</p>
                                        <h4 class="mb-0" id="today_card_amount">0</h4>
                                    </div>
                                    <div class="text-primary">
                                        <i class="ri-briefcase-4-line font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="min-height: 500px">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Now Checkin Customers</h4>

                        <div class="table-responsive mt-3">
                            <table class="table table-centered datatable dt-responsive nowrap "
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 20px;">
                                            #
                                        </th>
                                        {{-- <th>Name</th>
                                        <th>mobile</th> --}}
                                        <th> Number</th>
                                        {{-- <th>Vehicle</th> --}}
                                        {{-- <th>Stay Time</th> --}}
                                        <th>Sales Person</th>
                                        {{-- <th>Payment Mode</th>
                                        <th>Bill Amount</th>
                                        <th>Bill Number</th>
                                        <th>Date</th> --}}
                                        <!--<th>P आने का समय	</th>-->
                                        <th>Member</th>
                                    </tr>
                                </thead>
                                <tbody id="checkin_customers">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- container-fluid -->
@endsection
@section('scripts')
    <script type="text/javascript">
        function getDashboardData() {
            $.ajax({
                url: '{{ route('admin.dashboard') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                type: "GET",
                data: {},
                beforeSend: function() {

                },
                success: function(response) {
                    $('#today_customers').text(response.today_customers);
                    $('#today_sale').text('₹ ' + response.today_sale);
                    $('#total_customers').text(response.total_customers);
                    $('#total_sale').text('₹ ' + response.total_sale);
                    $('#today_cash_amount').text('₹ ' + response.today_cash_amount);
                    $('#today_upi_amount').text('₹ ' + response.today_upi_amount);
                    $('#today_card_amount').text('₹ ' + response.today_card_amount);
                    $('#checkin_customers').html(response.html);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }
        getDashboardData();
        setInterval(function() {
            getDashboardData();
        }, 30000);
    </script>
    <script src="{{ asset('admin/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- jquery.vectormap map -->
    <script src="{{ asset('admin/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('admin/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}"></script>
    <script src="{{ asset('admin/js/pages/dashboard.init.js') }}"></script>
@endsection
