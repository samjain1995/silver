<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ getSiteSettings()->company_name }}</title>

    <link rel="shortcut icon" href="{{ getSiteSettings()->company_favicon }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    {{-- Theme Css --}}

    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('admin/libs/toastr/build/toastr.min.css') }}" />
    <style>
        .typeahead {
            width: 30%;
        }
    </style>
</head>

<body>
    @yield('content')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js">
    </script>
    <script src="{{ asset('admin/libs/toastr/build/toastr.min.js') }}"></script>


    <script type="text/javascript">
        function checkRequiredValidation(form_id) {
            var is_invalid_input = 0;
            $('.error-span').text('');
            $('.form-control').removeClass('is-invalid');
            $(form_id).find('.form-control').each(function() {
                var required_attr = $(this).attr('required');
                if (typeof required_attr !== typeof undefined && required_attr !== false) {
                    if (!$(this).val()) {
                        is_invalid_input = 1
                        var input_name = $(this).attr('name');
                        input_name = input_name.replace("_", " ");
                        // input_name = input_name.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                        //     return letter.toUpperCase();
                        // });
                        $(this).addClass('is-invalid');
                        $('#error_' + $(this).attr('name')).text('The ' + input_name + ' field is required.');
                    }
                }
            })

            if (is_invalid_input == 1) {
                return false;
            } else {
                return true;
            }
        }

        function callPostAjax(url, form_id, reload_page, succrss_redirect = 0, succrss_redirect_url = '') {
            if (checkRequiredValidation(form_id)) {
                $(".form-control").removeClass("is-invalid");
                $('.error-span').text('');
                $.ajax({
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    method: 'post',
                    data: new FormData($(form_id)[0]),
                    beforeSend: function() {
                        $("#preloader").show();
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#preloader').hide();
                        if (response.status == true) {
                            $(form_id).trigger("reset");
                            if (succrss_redirect == 1) {
                                window.location.href = succrss_redirect_url;
                            } else if (reload_page == 1) {
                                toastr.success('Success', response.message, {
                                    timeOut: 5000
                                });
                                window.location.reload();
                            } else {
                                toastr.success('Success', response.message, {
                                    timeOut: 5000
                                });
                            }
                        } else if (response.status == 'validator_error') {
                            $.each(response.errors, function(index, html) {
                                $(form_id).find('input[name="' + index + '"]').addClass(
                                    'is-invalid');
                                $('#error_' + index).text(html);
                            });
                        } else {
                            toastr.error('Error', response.message, {
                                timeOut: 5000
                            });
                        }
                    }
                });
            }
        }
    </script>
    @if (session('success'))
        <script>
            toastr.success('Success', '{{ session('success') }}', {
                timeOut: 5000
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            toastr.error('Error', '{{ session('error') }}', {
                timeOut: 5000
            });
        </script>
    @endif
    @yield('scripts')
</body>

</html>
