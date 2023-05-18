@extends('layouts.admin')
@section('content')
    <div class="container-fluid" ng-controller="PageController">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Modules</h4>
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
                                <form action="{{ route('admin.modules.index') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="name" class="form-control" placeholder="Name"
                                                    value="{{ app('request')->input('name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Search</button>

                                                <a href="{{ route('admin.modules.index') }}"
                                                    class="btn btn-danger waves-effect waves-light">Clear</a>
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
                        <div>
                            <button class="btn btn-success mb-2" ng-click="openAddmodel()">
                                <i class="mdi mdi-plus mr-2"></i> Add Aodule
                            </button>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table table-centered datatable dt-responsive nowrap "
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input select-all"
                                                    id="customercheck">
                                                <label class="custom-control-label" for="customercheck">#</label>
                                            </div>
                                        </th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th style="width: 150px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = app('request')->input('page') && app('request')->input('page') > 1 ? (app('request')->input('page') - 1) * 50 + 1 : 1;
                                    @endphp

                                    @if (!empty($modules) && count($modules) > 0)
                                        @foreach ($modules as $key => $item)
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input select-row-id"
                                                            id="checkbox{{ $item->id }}" value="{{ $item->id }}">
                                                        <label class="custom-control-label"
                                                            for="checkbox{{ $item->id }}">
                                                            {{ $count }}</label>
                                                    </div>
                                                </td>
                                                <td> {{ $item->name }}</td>
                                                <td>
                                                    {{ date('d-m-Y', strtotime($item->created_at)) }}
                                                </td>
                                                <td>
                                                    <button
                                                        class="btn btn-outline-dark btn-sm waves-effect waves-light row-edit-button"
                                                        ng-click="openEditModel('{{ route('admin.modules.edit', $item->id) }}')">
                                                        <i class="ri-edit-box-line font-size-18"></i>
                                                    </button>

                                                    <a href="{{ route('admin.permissions.index', ['module_id' => $item->id]) }}"
                                                        class="btn btn-outline-warning  btn-sm waves-effect waves-light row-edit-button">
                                                        <i class="ri-creative-commons-zero-line font-size-18"></i>
                                                    </a>

                                                    {{-- <button
                                                        class="btn btn-outline-danger btn-sm waves-effect waves-light row-delete-button"
                                                        delete-url="{{ route('admin.modules.destroy', $item->id) }}">
                                                        <i class="mdi mdi-trash-can font-size-18"></i>
                                                    </button> --}}
                                                </td>
                                            </tr>
                                            @php
                                                $count++;
                                            @endphp
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                <strong>No Data Found</strong>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="mb-2 text-right">
                            {{ $modules->appends(app('request')->input())->links() }}
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
        app.controller('PageController', function($window, $scope, $rootScope, $location, $http, ngDialog, toaster) {
            $scope.openAddmodel = function() {
                $scope.add_form_model = ngDialog.open({
                    template: '{{ route('admin.modules.create') }}',
                    scope: $scope,
                    overlay: true,
                    closeByEscape: true,
                    closeByDocument: false,
                });
            }
            $scope.form_filds = {

            };
            $scope.add_validation_errors = {};
            $scope.submitAddForm = function(form_id) {
                $.each($scope.add_validation_errors, function(index, html) {
                    $scope.add_validation_errors[index] = '';
                });
                $(".form-control").removeClass("is-invalid");
                var formdata = $rootScope.makejsonToFormData($scope.form_filds);
                $http.post('{{ route('admin.modules.store') }}', formdata, $rootScope.post_request_headers)
                    .then(function(response) {
                        if (response.data.status == true) {
                            toaster.pop('success', response.data.message);
                            $scope.add_form_model.close();
                            location.reload();

                        } else if (response.data.status == 'validator_error') {
                            $.each(response.data.errors, function(index, html) {
                                $(form_id).find('input[name="' + index + '"]').addClass(
                                    'is-invalid');
                                $scope.add_validation_errors[index] = html[0];
                            });
                        } else {
                            toaster.pop('error', response.data.message);
                        }
                    }, function(error) {

                    });
            }
            $scope.edit_form_filds = {};
            $scope.openEditModel = function(url) {
                $scope.edit_form_model = ngDialog.open({
                    template: url,
                    scope: $scope,
                    overlay: true,
                    closeByEscape: true,
                    closeByDocument: false,
                });
            }
            $scope.edit_form_filds = {};
            $scope.edit_validation_errors = {};

            $scope.submitEditForm = function(form_id, update_url) {

                $.each($scope.edit_validation_errors, function(index, html) {
                    $scope.edit_validation_errors[index] = '';
                });
                $(".form-control").removeClass("is-invalid");
                var formdata = $rootScope.makejsonToFormData($scope.edit_form_filds);
                $http.post('{{ route('admin.modules.store') }}', formdata, $rootScope
                        .post_request_headers)
                    .then(function(response) {
                        if (response.data.status == true) {
                            toaster.pop('success', response.data.message);
                            $scope.edit_form_model.close();
                            location.reload();

                        } else if (response.data.status == 'validator_error') {
                            $.each(response.data.errors, function(index, html) {
                                $(form_id).find('input[name="' + index + '"]').addClass(
                                    'is-invalid');
                                $scope.edit_validation_errors[index] = html[0];
                            });
                        } else {
                            toaster.pop('error', response.data.message);
                        }
                    }, function(error) {

                    });
                return;
                /* $(form_id).submit();
                return; */


                var formdata = $rootScope.makejsonToFormData($scope.edit_form_filds);
                /* formdata.append('_method', 'PATCH');
                formdata.append('_token', '{{ csrf_token() }}'); */

                $http.patch(update_url, formdata)
                    .then(function(response) {
                        if (response.data.status == true) {
                            toaster.pop('success', response.data.message);
                            $scope.add_form_model.close();
                            location.reload();

                        } else if (response.data.status == 'validator_error') {
                            $.each(response.data.errors, function(index, html) {
                                $(form_id).find('input[name="' + index + '"]').addClass(
                                    'is-invalid');
                                $scope.add_validation_errors[index] = html[0];
                            });
                        } else {
                            toaster.pop('error', response.data.message);
                        }
                    }, function(error) {

                    });
            }




            $scope.getTheFiles = function($files, fild_array, fild_name) {
                if ($files.length == 1) {
                    $scope[fild_array][fild_name] = $files[0];
                } else {
                    var selscted_files = [];
                    angular.forEach($files, function(value, key) {
                        selscted_files[key] = value;
                    });
                    $scope[fild_array][fild_name] = selscted_files;
                }
            };

        });

        function submitJsEditForm(form_id, update_url) {
            var formData = $(form_id)[0];
            formData = new FormData(formData);
            formData.append('_method', 'PATCH');
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                url: update_url,
                method: 'PATCH',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "_method": 'PATCH'
                },
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    //$("#loader_img").show();
                },
                success: function(data) {

                }
            });
        }
    </script>
@endsection
