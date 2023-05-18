<style>
        .field-icon {
            float: right;
            margin-right: 10px;
            margin-top: -36px;
            position: relative;
            z-index: 2;
            cursor: pointer;
        }


        .password-container{
                width: 400px;
                position: relative;
            }
            .password-container input[type="password"],
            .password-container input[type="text"]{
                width: 100%;
                padding: 12px 36px 12px 12px;
                box-sizing: border-box;
            }
            
            @media (max-width: 1023px) {
                .mobile-hidden {
                    display: none !important;
                }
                .fa-eye {
                    position: absolute;
                    right: 25px;
                    top: 226px;
                    cursor: pointer;
                    color: lightgray;
                }
            }
            @media (min-width: 760px) {
                .fa-eye {
                    position: absolute;
                    right: 415px;
                    top: 200px;
                    cursor: pointer;
                    color: lightgray;
                }
            }

            @media (min-width: 1400px) {
                .fa-eye {
                    position: absolute;
                    right: 495px !important;
                    top: 198px !important;
                    cursor: pointer;
                    color: lightgray;
                
                }
            }
            @media (min-width: 2400px) {
                .fa-eye {
                    position: absolute;
                    right: 1052px !important;
                    top: 198px !important;
                    cursor: pointer;
                    color: lightgray;
                
                }
            }

            @media (min-width: 1023px) and (max-width: 1030px) {
            .desktop-hidden {
                display: none !important;
            }
            .fa-eye {
                position: absolute;
                right: 285px;
                top: 199px;
                cursor: pointer;
                color: lightgray;
            }
            
            }
    </style>

@extends('layouts.app')



@section('content')

  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <div class="registration-form">

        <form style="margin-top: 100px;" action="{{ route('login') }}" method="POST">

            @csrf

            <div class="form-icon">

                <img src="{{ getSiteSettings()->company_logo }}" height="50px" alt="">

                <!-- <span><i class="icon icon-user"></i></span> -->

            </div>

            <div class="form-group">

                <i class="fa-solid fa-mobile-screen-button fa-lg ml-2" style="color: #04345d;"></i>

                <input type="number" class="form-control item @error('mobile') is-invalid @enderror" name="mobile"

                    style="padding-left: 40px;" placeholder="Mobile Number [ मोबाइल नंबर ]" value="{{ old('mobile') }}"

                    required autocomplete="mobile" autofocus>


                @error('mobile')

                    <span class="invalid-feedback" role="alert">

                        <strong>{{ $message }}</strong>

                    </span>

                @enderror

            </div>

            <div class="form-group">

                <i class="fa-solid fa-lock fa-lg ml-2" style="color: #04345d;"></i>

                <input type="password"  class="form-control item @error('password') is-invalid @enderror"

                    style="padding-left: 40px;" placeholder="password [ पासवर्ड ]" name="password" id="password" required

                    autocomplete="current-password">

                    <i class="fa-solid fa-eye" id="eye"></i>


                @error('password')

                    <span class="invalid-feedback" role="alert">

                        <strong>{{ $message }}</strong>

                    </span>

                @enderror

            </div>

            <a href="javascript:void(0);">

                <p class="d-flex justify-content-end" style="color: black;">Unable to Login ? Contact Us</p>

            </a>

            <div class="form-group" style="margin-bottom: 35px;">

                <button type="submit" class="btn btn-block create-account"> Login</button>

            </div>
            

        </form>



    </div>

    <script>
        const passwordInput = document.querySelector("#password")
        const eye = document.querySelector("#eye")

        eye.addEventListener("click", function(){
        this.classList.toggle("fa-eye-slash")
        const type = passwordInput.getAttribute("type") === "password" ? "text" : "password"
        passwordInput.setAttribute("type", type)
        })
    </script>

    


@endsection

    