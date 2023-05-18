<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ getSiteSettings()->company_name }}</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ getSiteSettings()->company_favicon }}">
    <!-- Bootstrap Css -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('admin/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <style>
        @media screen and (max-width: 32in) {
            .table .thead-light th {
                color: #fff;
                background-color: #f7c51b;
                border-color: #eff2f7;
                font-weight: 800;
                font-size: 25px;
            }

            tbody {
                background: #091661;
                color: #fff;
                font-size: 25px;
            }
        }
    </style>
</head>

<body class="auth-body-bg" style="background:#222;color:#fff">
    <div class="home-btn d-none d-sm-block">

    </div>
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-lg-12">
                <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                    <div class="w-100">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div>
                                    <div class="text-center mt-2">
                                        <div>
                                            <a href="{{ url('/') }}" class="logo">
                                                <img src="{{ getSiteSettings()->company_logo }}" height="50"
                                                    alt="logo" style="margin-top:40px">
                                            </a>
                                        </div>
                                        <h4 class="font-size-18 mt-1 text-white">Live Check-In Customers</h4>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card" style="min-height: 500px">
                                                <div class="card-body" style="background:#222;color:#fff">
                                                    <div class="table-responsive mt-3">
                                                        <table
                                                            class="table table-centered datatable dt-responsive nowrap "
                                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th style="width: 20px;">
                                                                        #
                                                                    </th>
                                                                    <th> Number</th>
                                                                    <th>P आने का समय:</th>
                                                                    <th>Sales Person</th>
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

                                    <div class="mt-5 text-center">
                                        <p>© {{ date('Y') }} {{ getSiteSettings()->company_name }}. Crafted with <a href="https://fbipool.com">FBIP</a>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('admin/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('admin/js/app.js') }}"></script>
    @yield('scripts')

    <script type="text/javascript">
        function getDashboardData() {
            $.ajax({
                url: '{{ route('tv-screen') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                type: "GET",
                data: {},
                beforeSend: function() {

                },
                success: function(response) {
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
</body>

</html>
