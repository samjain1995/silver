@extends('layouts.admin')
@section('content')
    <div class="container-fluid" ng-controller="AngularPageController">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Change Password</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form class="needs-validation" method="POST" action="{{route('admin.password.update')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="old_password">Old Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="old_password"
                                            placeholder="Old Password" value="" name="old_password" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="new_password">New Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="new_password"
                                            placeholder="New Password" value="" name="new_password" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="confirm_password"
                                            placeholder="Confirm Password" value="" name="confirm_password" required>
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
        app.controller('AngularPageController', function($window, $scope, $location, $http, ngDialog, toaster) {

        });
    </script>
@endsection
