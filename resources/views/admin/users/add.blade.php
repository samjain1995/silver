@extends('layouts.admin')

@section('content')

    <div class="container-fluid" ng-controller="PageController">

        <!-- start page title -->

        <div class="row">

            <div class="col-12">

                <div class="page-title-box d-flex align-items-center justify-content-between">

                    <h4 class="mb-0">User Add</h4>

                </div>

            </div>

        </div>



        <div class="row">

            <div class="col-xl-12">

                <div class="card">

                    <div class="card-body">

                        <form class="needs-validation" method="POST" action="{{ route('admin.users.store') }}">

                            @csrf

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="name">First Name<span class="text-danger">*</span></label>

                                        <input type="text" class="form-control" id="first_name" placeholder="First Name"
                                            value="{{ old('first_name') }}" name="first_name" required />

                                        @if ($errors->has('first_name'))
                                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                        @endif

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="last_name">Last Name
                                            {{-- <span class="text-danger">*</span> --}}
                                        </label>

                                        <input type="text" class="form-control" id="last_name" placeholder="Last Name"
                                            value="{{ old('last_name') }}" name="last_name" />

                                        @if ($errors->has('last_name'))
                                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                        @endif

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="name">Email<span class="text-danger">*</span></label>

                                        <input type="email" class="form-control" id="email" placeholder="Email"
                                            value="{{ old('email') }}" name="email" required />

                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="name">Mobile<span class="text-danger">*</span></label>

                                        <input type="text" class="form-control" id="mobile" placeholder="mobile"
                                            value="{{ old('mobile') }}" name="mobile" required />



                                        @if ($errors->has('mobile'))
                                            <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                        @endif

                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="password" placeholder="password"
                                            value="{{ old('password') }}" name="password" required />
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label">Gender<span class="text-danger">*</span></label>

                                        <select class="form-control select2" name="gender">

                                            <option value="">Select</option>

                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male

                                            </option>

                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>

                                                Female

                                            </option>

                                        </select>

                                        @if ($errors->has('gender'))
                                            <span class="text-danger">{{ $errors->first('gender') }}</span>
                                        @endif

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label">Role<span class="text-danger">*</span></label>

                                        <select class="form-control select2" name="role_id">

                                            <option value="">Select</option>

                                            @if ($roles && count($roles) > 0)
                                                @foreach ($roles as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('role_id') == $item->id ? 'selected' : '' }}>

                                                        {{ $item->name }}</option>
                                                @endforeach
                                            @endif

                                        </select>



                                        @if ($errors->has('role_id'))
                                            <span class="text-danger">{{ $errors->first('role_id') }}</span>
                                        @endif

                                    </div>



                                </div>



                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label for="company_address"> Adderss <span class="text-danger">*</span></label>

                                        <textarea class="form-control " id="ckeditor" name="address" rows="3">{{ old('address') }}</textarea>

                                        @if ($errors->has('address'))
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                        @endif

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
    @include('layouts.ckeditor-script')

    <script type="text/javascript">
        app.controller('PageController', function($window, $scope, $location, $http, ngDialog, toaster) {



        });
    </script>
@endsection
