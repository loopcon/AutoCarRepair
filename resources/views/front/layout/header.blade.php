<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{isset($meta_description) ? $meta_description : ''}}">
    <meta name="keywords" content="{{isset($meta_keywords) ? $meta_keywords : ''}}">
    <title>{{$site_title.' | '. $site_name}}</title>
    <link rel="icon"  href="{{ asset('public/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}">
    @yield('css')
</head>
<body>
<!-- topbar html start  -->
<div class="container">
    <div class="row m-0 top-navbar-main">
        <div class="col-12 col-md-6">
            <img src="{{ asset('front/img/acr-logo.png') }}" class="acr-logo" alt="">
        </div>
        <div class="col-12 col-md-6">
            <div class="topbar-email-call">
                <div class="top-email-main">
                    <div class="email-main">
                        <img src="{{ asset('front/img/top-email.png') }}" alt="">
                    </div>
                    <div class="top-email-text">
                        <p >Mail</p>
                        <a href="mailto:{{$email}}">{{$email}}</a>
                    </div>
                </div>
                <div class="top-call-main">
                    <div class="call-img-main">
                        <img src="{{ asset('front/img/top-call.png') }}" alt="">
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
<div class="navbar-bg">
    <div class="container">
        <div class="acr-navbar-section">
            <div>
                @php($page = Request::segment(1))
                <ul class="acr-navbar-main">
                    <li><a class="@if($page == ''){{'acr-active'}}@endif" href="{{route('front_/')}}">Home</a></li>
                    <li><a class="@if($page == 'our-services'){{'acr-active'}}@endif" href="{{route('front_our-services')}}">Car Service</a></li>
                    <li><a href="http://127.0.0.1:5500/shop-center.html">Service Center</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="http://127.0.0.1:5500/shopping.html">Shopping</a></li>
                </ul>
            </div>
            <div class="search-main-section">
                <div class="search-icon-main">
                    <img data-bs-toggle="modal" data-bs-target="#searchbarModal"  src="{{ asset('front/img/navbar-search-icon.png') }}" alt="">
                </div>
                <div class="modal fade" id="searchbarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog searchbar-dialog">
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
                    <a class="navbar-appointment-btn" href="#" data-bs-toggle="modal" data-bs-target="#appointmentModal" >Appointment Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- mobile menu start  -->
<div class="mobile-menu-main">    
    <div class="container">
        <div class="mobile-menu-sectiondata">
            <div class="mo-logo">
                <img src="{{ asset('front/img/acr-logo.png') }}" class="acr-logo" alt="">
            </div>
            <div class="mo-appointmentbtn">
                <div class="mo-search-main-section">
                    <div class="search-icon-main">
                        <img data-bs-toggle="modal" data-bs-target="#mosearchbarModal"  src="{{ asset('front/img/navbar-search-icon.png') }}" alt="">
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
                        <a class="navbar-appointment-btn" href="#" data-bs-toggle="modal" data-bs-target="#appointmentModal" >Appointment Now</a>
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
                        <li><a class="@if($page == 'our-services'){{'acr-active'}}@endif" href="{{route('front_our-services')}}">Car Service</a></li>
                        <li><a href="#">Service Center</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Shopping</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- mobile menu end  -->
<!-- Appointment modal -->  
<div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog appointment-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="appointment-contet-modal">
                    <h1>Experience The Best Car Service In Delhi</h1>
                    <div class="appointment-car-service">
                        <p>Get instant quotes for four car service  </p>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"  class="check-price-btn" data-bs-toggle="modal" data-bs-target="#appointmentselectModal">Check Price For Free </button>
            </div>
        </div>
    </div>
</div>
<!-- Appointment modal -->
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
                        <input type="text" class="form-control search-brand-input" placeholder="Search Brand"  aria-label="Amount (to the nearest dollar)">
                        <div class="search-icon">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        </div>
                    <div class="row m-0">
                        <div class="col-4 brand-logo-center">
                            <a href="" data-bs-toggle="modal" data-bs-target="#appointmentsearchModal"><img src="{{ asset('front/img/Maruti-Suzuki-Logo.png')}}" class="img-fluid" alt=""></a>
                        </div>
                        <div class="col-4 brand-logo-center">
                            <a href="#"><img src="{{ asset('front/img/mahindra-new.png') }}" class="img-fluid" alt=""></a>
                        </div>
                        <div class="col-4 brand-logo-center">
                            <a href="#"><img src="{{ asset('front/img/toyota-logos.png') }}" class="img-fluid" alt=""></a>
                        </div>
                        <div class="col-4 brand-logo-center">
                            <a href="#"><img src="{{ asset('front/img/hyundai-logo.png') }}" class="img-fluid" alt=""></a>
                        </div>
                        <div class="col-4 brand-logo-center">
                            <a href="#"><img src="{{ asset('front/img/Tata-Group-logo.png') }}" class="img-fluid" alt=""></a>
                        </div>
                        <div class="col-4 brand-logo-center">
                            <a href="#"><img src="{{ asset('front/img/Volkswagen-logo.png') }}" class="img-fluid" alt=""></a>
                        </div>
                        <div class="col-4 brand-logo-center">
                            <a href="#"><img src="{{ asset('front/img/mercedes-benz.png') }}" class="img-fluid" alt=""></a>
                        </div>
                        <div class="col-4 brand-logo-center">
                            <a href="#"><img src="{{ asset('front/img/bmw-logo.png') }}" class="img-fluid" alt=""></a>
                        </div>
                        <div class="col-4 brand-logo-center">
                            <a href="#"><img src="{{ asset('front/img/Volvo-logo.png') }}" class="img-fluid" alt=""></a>
                        </div>
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
                    <h1>Select Modal</h1>
                    <div class="input-group">
                        <input type="text" class="form-control search-brand-input" placeholder="Search Modal"  aria-label="Amount (to the nearest dollar)">
                        <div class="search-icon">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                    </div>
                    <div class="row m-0 search-modal-box">
                        <div class="col-4 brand-logo-center">
                            <a href="#"  data-bs-toggle="modal" data-bs-target="#appointmentfuelModal"><img src="{{ asset('front/img/rits.png')}}" class="img-fluid" alt="">
                                <p class="select-modal-name">Ritz</p>
                            </a>
                        </div>
                        <div class="col-4 brand-logo-center">
                            <a href="#"><img src="{{ asset('front/img/swift-old.png') }}" class="img-fluid" alt="">
                                <p class="select-modal-name">Swift</p>
                            </a>
                        </div>
                        <div class="col-4 brand-logo-center">
                            <a href="#"><img src="{{ asset('front/img/swift-old.png') }}" class="img-fluid" alt="">
                                <p class="select-modal-name">Swift</p>
                            </a>
                        </div>
                        <div class="col-4 brand-logo-center">
                            <a href="#"><img src="{{ asset('front/img/wagonr.png') }}" class="img-fluid" alt="">
                                <p class="select-modal-name">Wagon R</p>
                            </a>
                        </div>
                        <div class="col-4 brand-logo-center">
                            <a href="#"><img src="{{ asset('front/img/baleno.png') }}" class="img-fluid" alt="">
                                <p class="select-modal-name">Baleno</p>
                            </a>
                            
                        </div>
                        <div class="col-4 brand-logo-center">
                            <a href="#"><img src="{{ asset('front/img/rits.png') }}" class="img-fluid" alt="">
                                <p class="select-modal-name">Ritz</p>
                            </a>
                        </div>
                        <div class="col-4 brand-logo-center">
                            <a href="#"><img src="{{ asset('front/img/baleno.png') }}" class="img-fluid" alt="">
                                <p class="select-modal-name">Baleno</p>
                            </a>
                        </div>
                        <div class="col-4 brand-logo-center">
                            <a href="#"><img src="{{ asset('front/img/swift.png') }}" class="img-fluid" alt="">
                                <p class="select-modal-name">Swift</p>
                            </a>
                        </div>
                        <div class="col-4 brand-logo-center">
                            <a href="#"><img src="{{ asset('front/img/wagonr.png') }}" class="img-fluid" alt="">
                                <p class="select-modal-name">wagon R</p>
                            </a>
                        </div>
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
                    <input type="text" class="form-control search-brand-input" placeholder="Search Fuel"  aria-label="Amount (to the nearest dollar)">
                    <div class="search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
                <div class="row m-0 search-modal-box">
                    <div class="col-4 brand-logo-center">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#appointmentnumberModal" ><img src="{{ asset('front/img/PETROL.png')}}" class="img-fluid" alt="">
                            <p class="select-modal-name">Petrol</p>
                        </a>
                    </div>
                    <div class="col-4 brand-logo-center">
                        <a href="#"><img src="{{ asset('front/img/CNG.png') }}" class="img-fluid" alt="">
                            <p class="select-modal-name">CNG</p>
                        </a>
                    </div>
                    <div class="col-4 brand-logo-center">
                        <a href="#"><img src="{{ asset('front/img/DIESEL.png') }}" class="img-fluid" alt="">
                            <p class="select-modal-name">Diesel</p>
                        </a>
                    </div>
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
                    <h1>Select Fuel Type </h1>
                    <div class="row m-0 search-modal-box">
                        <div class="col-4 brand-logo-center">
                           <a href="#"><img src="{{ asset('front/img/Maruti-Suzuki-Logo.png') }}" class="img-fluid" alt="">
                           </a>
                        </div>
                        <div class="col-4 brand-logo-center">
                            <a href="#"><img src="{{ asset('front/img/swift.png') }}" class="img-fluid" alt="">
                                <p class="select-modal-name">Swift</p>
                            </a>
                        </div>
                        <div class="col-4 brand-logo-center">
                            <a href="#"><img src="{{ asset('front/img/DIESEL.png') }}" class="img-fluid" alt="">
                                <p class="select-modal-name">Diesel</p>
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="tel" class="form-control"   id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Phone Number">
                      </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="check-price-btn-main" href="#"><button type="button"  class="check-price-btn" >Check Price For Free </button></a>
            </div>
        </div>
    </div>
</div>
<!-- Appointment Number modal -->
<!-- navbar end  -->