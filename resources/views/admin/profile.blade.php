@extends('layouts.admin')
@section('content')
    <div class="container-fluid" ng-controller="AngularPageController">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Profile</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form class="needs-validation" method="POST" action="{{ route('admin.update.profile') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="old_password">First Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="first_name" placeholder="First Name"
                                            value="{{ Auth::user()->first_name }}" name="first_name" required />
                                        @if ($errors->has('first_name'))
                                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="old_password">Last Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="last_name" placeholder="Last Name"
                                            value="{{ Auth::user()->last_name }}" name="last_name" required />
                                        @if ($errors->has('last_name'))
                                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="old_password">Mobile<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="mobile" placeholder="mobile"
                                            value="{{ Auth::user()->mobile }}" name="mobile" required />
                                        @if ($errors->has('mobile'))
                                            <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="old_password">Email<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="email" placeholder="Email"
                                            value="{{ Auth::user()->email }}" name="email" required readonly />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Gender<span class="text-danger">*</span></label>
                                        <select class="form-control select2" name="gender">
                                            <option value="">Select</option>
                                            <option value="male"
                                                {{ old('gender', Auth::user()->gender) == 'male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="female"
                                                {{ old('gender', Auth::user()->gender) == 'female' ? 'selected' : '' }}>
                                                Female
                                            </option>
                                        </select>
                                        @if ($errors->has('gender'))
                                            <span class="text-danger">{{ $errors->first('gender') }}</span>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="old_password">Image</label>
                                        <input type="file" class="form-control" name="image" />
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
