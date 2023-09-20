<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{isset($meta_description) ? $meta_description : ''}}">
    <meta name="keywords" content="{{isset($meta_keywords) ? $meta_keywords : ''}}">
    <meta name="tag" content="{!!isset($extra_meta_tag) ? $extra_meta_tag : '' !!}">
    <meta name="extra_meta_description" content="{!! isset($extra_meta_description) ? strip_tags($extra_meta_description) : '' !!}">
    <title>{{$site_title.' | '. $site_name}}</title>
    <link rel="icon"  href="{{ asset('public/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}">
    <link rel="stylesheet" href="{{asset('plugins/notification/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/plugins/sweetalert/sweetalert.css')}}">
    @yield('css')
</head>
<body>
<!-- topbar html start  -->
<div class="container">
    <div class="row m-0 top-navbar-main">
        <div class="col-12 col-md-6">
             <a href="{{route('front_/')}}"><img src="{{ asset('front/img/acr-logo.webp') }}" class="acr-logo" alt=""></a>
        </div>
        <div class="col-12 col-md-6">
            <div class="topbar-email-call">
                <div class="top-email-main">
                    <div class="email-main">
                        <img src="{{ asset('front/img/top-email.webp') }}" alt="">
                    </div>
                    <div class="top-email-text">
                        <p >Mail</p>
                        <a href="mailto:{{$email}}">{{$email}}</a>
                    </div>
                </div>
                <div class="top-call-main">
                    <div class="call-img-main">
                        <img src="{{ asset('front/img/top-call.webp') }}" alt="">
                    </div>
                    <div class="top-call-text">
                        <p>Call US</p>
                        <a href="tel:{{$phone}}"> {{$phone}} </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- topbar end  -->
<!-- navbar start  -->
<div class="navbar-bg" id="header-sticky">
    <div class="container">
        <div class="acr-navbar-section">
            <div>
                @php($page = Request::segment(1))
                <ul class="acr-navbar-main">
                    <li><a class="@if($page == ''){{'acr-active'}}@endif" href="{{route('front_/')}}">Home</a></li>
                    <li><a class="@if($page == 'our-services'){{'acr-active'}}@endif" href="{{url('our-services')}}">Car Service</a></li>
                    <li><a  class="@if($page == 'service-center'){{'acr-active'}}@endif" href="{{url('service-center')}}">Service Center</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a class="@if($page == 'shopping'){{'acr-active'}}@endif" href="{{url('shopping')}}">Shopping</a></li>
                    <li><a href="#">Offers</a></li>
                </ul>
            </div>
            <div class="search-main-section">
                <div class="search-icon-main">
                    <?php /* <img data-bs-toggle="modal" data-bs-target="#searchbarModal"  src="{{ asset('front/img/navbar-search-icon.png') }}" alt=""> */ ?>
                     <span class="search-svg-main" data-bs-toggle="modal" data-bs-target="#searchbarModal" ><i class="fa-solid fa-magnifying-glass"></i></span>
                </div>
                <div>
                    <a class="navbar-appointment-btn apt-btn" href="javascript:void(0)" >Book A Service</a>
                </div>
            </div>
            <div>
                <ul class="login-drop-main">
                    <li class="dropdown ">
                        <a class="nav-link login-icon-text dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user"></i>
                        </a>
                        <ul class="dropdown-menu login-icon-main" aria-labelledby="navbarDropdown">
                            @if(!Auth::guard('user')->check())
                                <li><a class="dropdown-item text-black" href="{{route('front_login')}}">Login</a></li>
                                <li><a class="dropdown-item text-black" href="{{route('front_register')}}">Register</a></li>
                            @else
                                <li><a class="dropdown-item text-black" href="{{route('front_my-profile')}}">My Profile</a></li>
                                <li><a class="dropdown-item text-black" href="{{route('front_my-orders')}}">My Orders</a></li>
                                <li><a class="dropdown-item text-black" href="{{route('front_logout')}}">Logout</a></li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
            <a href="{{url('checkout')}}" class="card-icon-main"><i class="fa fa-cart-plus"></i><span id="cart_header_total_item"></span></a>
        </div>
    </div>
</div>
<!-- mobile menu start  -->
<div class="mobile-menu-main">    
    <div class="container">
        <div class="mobile-menu-sectiondata">
            <div class="mo-logo">
                <a href="{{route('front_/')}}"><img src="{{ asset('front/img/acr-logo.webp') }}" class="acr-logo" alt=""></a>
            </div>
            <div class="mo-appointmentbtn">
                <div class="mo-search-main-section">
                    <div class="search-icon-main">
                        <?php /*<img data-bs-toggle="modal" data-bs-target="#mosearchbarModal"  src="{{ asset('front/img/navbar-search-icon.png') }}" alt=""> */ ?>
                        <span class="search-svg-main" data-bs-toggle="modal" data-bs-target="#mosearchbarModal" ><i class="fa-solid fa-magnifying-glass"></i></span>
                    </div>
                    <div class="modal fade" id="mosearchbarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog mosearchbar-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                  </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div>
                        <a class="navbar-appointment-btn apt-btn" href="javascript:void(0);" >Book A Service</a>
                    </div>
                </div>
            </div>
            <div class="toggle-btnmobile">
                <div class="toggle-btn">
                    <button class="btn-toggle-item"><i class="fa-solid fa-bars"></i></button>
                </div>
                <div class="mobile-toggle-data">
                    <ul class="mo-acr-navbar-main">
                        <li><a class="@if($page == ''){{'acr-active'}}@endif" href="{{route('front_/')}}">Home</a></li>
                        <li><a class="@if($page == 'our-services'){{'acr-active'}}@endif" href="{{url('our-services')}}">Car Service</a></li>
                        <li><a class="@if($page == 'service-center'){{'acr-active'}}@endif" href="{{url('service-center')}}">Service Center</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a class="@if($page == 'shopping'){{'acr-active'}}@endif" href="{{url('shopping')}}">Shopping</a></li>
                        <li><a href="{{url('checkout')}}" class="card-icon-main"><i class="fa fa-cart-plus"></i><span id="cart_header_total_item"></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- mobile menu end  -->

<!-- Appointment select modal -->  
<div class="modal fade" id="appointmentselectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog appointmentselect-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <h1>Select Brand</h1>
                    <div class="input-group">
                        <input type="text" class="form-control search-brand-input" id="search_brand" placeholder="Search Brand"  aria-label="Amount (to the nearest dollar)">
                        <div class="search-icon">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                    </div>
                    <div class="row m-0 select-brand-imgmain" id="amodal_brands">
                        @php($brands = getbrands())
                        @if($brands->count())
                            @foreach($brands as $brand)
                                @if($brand->image)
                                    <div class="col-4 brand-logo-center">
                                        <a href="javascript:void(0);" class="amodal-brand" data-id="{{$brand->id}}"><img src="{{ $brand->image }}" class="img-fluid" alt="" style="width:80px"></a>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- Appointment select modal -->
<!-- Appointment search modal -->
<div class="modal fade" id="appointmentsearchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog appointmentsearch-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <h1>Select Model</h1>
                    <div class="input-group">
                        <input type="text" class="form-control search-brand-input" id="search_model" placeholder="Search Model"  aria-label="Amount (to the nearest dollar)">
                        <div class="search-icon">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                    </div>
                    <div class="changeandbackmainbtn">
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#appointmentselectModal">Change</a>    
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#appointmentselectModal">Back</a>
                    </div>
                    <div class="row m-0 search-modal-box" id="amodal_models">

                    </div>
                </div>
            </div>
            <div class="modal-footer"> </div>
        </div>
    </div>
</div>
<!-- Appointment search modal -->
<!-- Appointment fuel modal -->
<div class="modal fade" id="appointmentfuelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog appointmentfuel-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div>
                <h1>Select Fuel Type </h1>
                <div class="input-group">
                    <input type="text" class="form-control search-brand-input" id="search_fuel" placeholder="Search Fuel"  aria-label="Amount (to the nearest dollar)">
                    <div class="search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
                <div class="changeandbackmainbtn">
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#appointmentselectModal">Change</a>    
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#appointmentsearchModal">Back</a>
                </div>
                <div class="row m-0 search-modal-box" id="amodal_fuels">
                </div>
            </div>
        </div>
        <div class="modal-footer"> </div>
    </div>
</div>
</div>
<!-- Appointment fuel modal -->
<!-- Appointment Number modal -->
<div class="modal fade" id="appointmentnumberModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog appointmentnumber-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <h1>Get instant quotes for your car service </h1>
                    <div class="changeandbackmainbtn">
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#appointmentselectModal">Change</a>    
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#appointmentfuelModal">Back</a>
                    </div>
                    <div class="row m-0 search-modal-box" id="search_info">

                    </div>
                    @if (!empty(Cache::get('phone')))
                    <div class="form-group" style="visibility: hidden;">
                        <input type="text" class="form-control num_only" maxlength="10"  id="appointmentmobile" name="mobile" aria-describedby="emailHelp" placeholder="Enter Phone Number" value="{{ Cache::get('phone') }}">
                    </div>
                    @else
                    <div class="form-group">
                        <input type="text" class="form-control num_only" maxlength="10"  id="appointmentmobile" name="mobile" aria-describedby="emailHelp" placeholder="Enter Phone Number" value="{{ Cache::get('phone') }}">
                    </div>
                    @endif
                </div>
                <div class="aptotp-section">
                    <div class="mb-3 otpinput-main">
                        <input type="text" class="form-control num_only" maxlength="4" id="appointmentotp" name="otp" aria-describedby="emailHelp" placeholder="OTP">
                        <div id="appointmentresend_text"><b>Resend OTP in <span id="apttimer"></span> seconds</b></div>
                    </div>
                    <!--<a href="javascript:void(0)" id="verify_otp" class="btn verify-otpbtn">VERIFY OTP </a>-->
                    <a href="javascript:void(0)" id="appointmentresend_otp" class="bookservice-resend-otp">RESEND OTP </a>
                </div>
                <input type="hidden" id="appointmentis_otp_verify" value="0">
                <a href="javascript:void(0)" class="btn check-price-btn mt-3" id="appointmentsend_otp">SEND OTP </a>

            </div>
            <div class="modal-footer">
                <a class="check-price-btn-main" id="check_price" href="javascript:void(0);"><button type="button"  class="check-price-btn" >Check Price For Free </button></a>
            </div>
        </div>
    </div>
</div>
<!-- Appointment Number modal -->
<!-- navbar end  -->
<div class="modal fade" id="searchbarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog searchbar-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <input type="text" class="form-control search_text" placeholder="Search" value="{{Request::get('search')}}" aria-label="Recipient's username" aria-describedby="basic-addon2">
                  </div>
            </div>
        </div>
    </div>
</div>
