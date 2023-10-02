@extends('front.layout.main')
@section('css')
    <link class="js-stylesheet" href="{{ asset('plugins/parsley/parsley.css') }}" rel="stylesheet">
@endsection
@section('content')
<?php /* <div class="shop-center-tophead">
    <img src="{{ asset('front/img/service-inner-bg.png') }}" class="img-fluid" alt="">
    <div class="shop-center-text">
        <h2>{{ strtoupper($site_title) }}</h2>
        <ul class="shop-center-breadcum">
            <li><a href="">Home</a></li>
            <li><i class="fa-solid fa-angles-right"></i></li>
            <li>{{ $site_title }}</li>
        </ul>
    </div>
</div> */ ?>

<?php /* <div class="loging-breadcrum-bg">
    <div class="container">
        <ul class="login-breadcrum-main">
            <li><a href="">Home</a></li>
            <li><i class="fa-solid fa-chevron-right"></i></li>
            <li>{{ $site_title }}</li>
        </ul>
    </div>
</div> */ ?>

<div class="login-section-main">
    <div >
        <div class="login-form-">
            <div class="row justify-content-center m-0">
                <div class="col-md-6 p-0">
                    <div class="login-img-main">
                        <img src="{{ asset('front/img/advance-service-main.webp') }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-md-6 align-items-center d-flex">
                    <div class="login-form-main">
                        <form method="post" action="{{route('front_login')}}" id="login-form" enctype="multipart/form-data" data-parsley-validate=''>
                            {{ csrf_field() }} 
                            <div class="mb-4">
                                 <label class="form-label email-text-heading">Email<span class="text-light">*</span></label>  
                                <input type="email" name="email" placeholder="EMAIL ID" required="" class="form-control input-login-main">
                            </div>
                            <div class="mb-4">
                                 <label class="form-label email-text-heading">Password<span class="text-light">*</span></label>  
                                <input type="password" name="password" id="password" placeholder="PASSWORD" class="form-control input-login-main" required="">
                                <a class="forget_msg forgetmsg" href="{{route('front_forgot-password')}}">Forget Password?</a>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="sign-up-btn-main">LOGIN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{ asset('plugins/parsley/parsley.js') }}"></script>
@endsection

