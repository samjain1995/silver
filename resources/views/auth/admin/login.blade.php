@extends('layouts.admin_auth')
@section('content')
    <div class="p-2 mt-5">
        <form class="form-horizontal" action="{{ route('admin-login') }}" method="POST">
            @csrf
            <div class="form-group auth-form-group-custom mb-4">
                <i class="ri-user-2-line auti-custom-input-icon"></i>
                <label for="username">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="username"
                    placeholder="Enter Email" name="email" value="{{ old('email') }}" required autocomplete="email"
                    autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group auth-form-group-custom mb-4">
                <i class="ri-lock-2-line auti-custom-input-icon"></i>
                <label for="userpassword">Password</label>
                <input type="password" class="form-control  @error('password') is-invalid @enderror" id="userpassword"
                    placeholder="Enter password" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mt-4 text-center">
                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
            </div>
            <div class="mt-4 text-center">
                <a href="javascript:void(0);" class="text-muted">
                    <i class="mdi mdi-lock mr-1"></i> Forgot your password?</a>
            </div>
        </form>
    </div>
@endsection
