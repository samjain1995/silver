<div class="wrap sticky-top pb-0" id="site_header">
    <div class="container logo_container">
        <div class="row justify-content-between">
            <div class="col-md-3 mb-md-0 d-flex align-items-center header_logo_col">
                <a class="navbar-brand" href="{{url('/')}}">
                    <img src="{{asset('front/chemisto_logo.jpg')}}" class="header_logo_image">  
                </a>
            </div>
            <div class="col-md-7 pt-4">
                <marquee><strong class="text-danger" style="font-size: 18px">REGISTER YOUR NAME AND GET SAMPLE WITH GIFT VOUCHER WORTH RS : 10,000</strong></marquee>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation" style="font-size: 25px">
                <span class="fa fa-bars"> Menu</span> 
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                        <a href="{{url('/')}}" class="nav-link">Home</a>
                    </li>

                    <li class="nav-item {{ Request::is('products') ? 'active' : '' }}">
                        <a href="{{route('products')}}" class="nav-link"  >Products</a>
                    </li>

                    <li class="nav-item {{ Request::is('blog') ? 'active' : '' }}">
                        <a href="{{route('blog')}}" class="nav-link  ">Blog</a>
                    </li>

                    <li class="nav-item  {{ Request::is('contact-us') ? 'active' : '' }}">
                        <a href="{{route('contact-us')}}" class="nav-link">Contact</a>
                    </li>

                    <li class="nav-item {{ Request::is('register') ? 'active' : '' }}">
                        <a href="{{route('register')}}" class="nav-link">Registration</a>
                    </li>
                    <li class="nav-item {{ Request::is('login') ? 'active' : '' }}">
                        <a href="{{route('login')}}" class="nav-link">Login</a>
                    </li>
                </ul>
               {{-- Customer  --}}
                {{-- <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item" >
                        <span style="color: #FFF;">
                            <a href="tel:7617616363" class="btn btn-primary" style="font-size: 17px;"><b>CUSTOMER CARE : 761 761 6363</b>
                            </a>
                        </span>
                    </li>
                </ul> --}}
            </div>
        </div>
    </nav>
</div>


