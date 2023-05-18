<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ getSiteSettings()->company_name }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ getSiteSettings()->company_favicon }}">
    <!-- Bootstrap Css -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- sweetalert2 Css -->
    <link href="{{ asset('admin/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- select2 Css-->
    <link href="{{ asset('admin/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('admin/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />


    {{-- Angular Css --}}
    <link rel="stylesheet" href="{{ asset('angular/ngDialog-theme-default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('angular/ngDialog.min.css') }}">
    <link rel="stylesheet" href="{{ asset('angular/toster/toaster.css') }}">

    <style>
        .ngdialog.ngdialog-theme-default .ngdialog-close:before {
            display: block;
            padding: 1px;
            background: 0 0;
            color: #ff0000;
            content: '\00D7';
            font-size: 35px;
            font-weight: 400;
            line-height: 26px;
            text-align: center;
            border: 3px solid #ff0000;
            border-radius: 13px;
        }
    </style>
</head>

<body data-sidebar="dark" ng-app="EcommerceApp">
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts/admin/header')
        <!-- Left Sidebar Start  -->
        @include('layouts/admin/sidebar')
        <!-- Left Sidebar End -->
        <div class="main-content">
            <div class="page-content">
                @yield('content')
            </div>
            <!-- End Page-content -->
            @include('layouts/admin/footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
    <!-- Right Sidebar Start -->
    @include('layouts/admin/right-bar')
    <!-- /Right-bar End-->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('admin/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('admin/libs/select2/js/select2.min.js') }}"></script>
    {{-- <script src="{{ asset('admin/js/pages/form-advanced.init.js') }}"></script> --}}
    <script src="{{ asset('admin/js/app.js') }}"></script>

    @include('layouts/notification')
    <script type="text/javascript">
        $(".select2").select2();
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.row-delete-button', function(event) {
                var delete_url = $(this).attr('delete-url');
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
                                _token: '{{ csrf_token() }}'
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
            });

            $(document).on("click", ".select-all", function() {
                if (this.checked) {
                    $('.select-row-id').each(function() {
                        this.checked = true;
                    });
                } else {
                    $('.select-row-id').each(function() {
                        this.checked = false;
                    });
                }
            });
        });
    </script>
    {{-- Angular Scripts --}}
    <script src="{{ asset('angular/angular.min.js') }}"></script>
    <script src="{{ asset('angular/angular-animate.min.js') }}"></script>
    <script src="{{ asset('angular/ngDialog.min.js') }}"></script>
    <script src="{{ asset('angular/toster/toaster.js') }}"></script>
    {{-- Angular App Scripts --}}
    <script src="{{ asset('angular/app/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
