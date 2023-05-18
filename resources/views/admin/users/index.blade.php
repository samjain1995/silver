@extends('layouts.admin')
@section('content')
    <div class="container-fluid" ng-controller="PageController">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Users</h4>
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
                                <form action="{{ route('admin.users.index') }}" method="GET">
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
                                                <label>Role</label>
                                                <select class="form-control select2" name="role">
                                                    <option value="">Select Role</option>
                                                    @if ($roles && count($roles))
                                                        @foreach ($roles as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Search</button>

                                                <a href="{{ route('admin.users.index') }}"
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
                            <a href="{{ route('admin.users.create') }}" class="btn btn-success mb-2">
                                <i class="mdi mdi-plus mr-2"></i>Add User
                            </a>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table table-centered datatable dt-responsive nowrap "
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="custom-control custom-checkbox">
                                                {{-- <input type="checkbox" class="custom-control-input" id="customercheck"> --}}
                                                <label class="custom-control-label" for="customercheck">#</label>
                                            </div>
                                        </th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Date</th>
                                        <th style="width: 120px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = app('request')->input('page') && app('request')->input('page') > 1 ? (app('request')->input('page') - 1) * 50 + 1 : 1;
                                    @endphp
                                    @if (!empty($users) && count($users) > 0)
                                        @foreach ($users as $key => $item)
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        @if ($item->role_id != 1)
                                                            {{-- <input type="checkbox" class="custom-control-input"
                                                                id="checkbox{{ $item->id }}">
                                                            <label class="custom-control-label"
                                                                for="checkbox{{ $item->id }}">
                                                                {{ $count }}</label> --}}
                                                        @else
                                                            {{ $count }}
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->mobile }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->role ? $item->role->name : '' }}</td>
                                                <td>
                                                    {{ date('d-m-Y', strtotime($item->created_at)) }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.users.edit', $item->id) }}"
                                                        class="btn btn-outline-dark btn-sm waves-effect waves-light row-edit-button">
                                                        <i class="ri-edit-box-line font-size-18"></i></a>
                                                    <button
                                                        class="btn btn-outline-danger btn-sm waves-effect waves-light row-delete-button"
                                                        delete-url="{{ route('admin.users.destroy', $item->id) }}">
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
                                            <td colspan="5" class="text-center">
                                                <strong>No Data Found</strong>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="mb-2 text-right">
                            {{ $users->appends(app('request')->input())->links() }}
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
        app.controller('PageController', function($window, $scope, $location, $http, ngDialog, toaster) {

        });
    </script>
@endsection
