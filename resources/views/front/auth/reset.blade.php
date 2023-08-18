@extends('front.layout.main')
@section('css')
    <link class="js-stylesheet" href="{{ asset('plugins/parsley/parsley.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="shop-center-tophead">
    <img src="{{ asset('front/img/service-inner-bg.png') }}" class="img-fluid" alt="">
    <div class="shop-center-text">
        <h2>{{ strtoupper($site_title) }}</h2>
        <ul class="shop-center-breadcum">
            <li><a href="">Home</a></li>
            <li><i class="fa-solid fa-angles-right"></i></li>
            <li>{{ $site_title }}</li>
        </ul>
    </div>
</div>

<div class="faq-section-main">
    <div class="container">
        <div class="row justify-content-center">
            <div class=" col-lg-6">
                 <form method="post" action="{{route('front_set-new-password')}}" id="login-form" enctype="multipart/form-data" data-parsley-validate=''>
                    {{ csrf_field() }} 
                    <input type="hidden" name="user_id" value="{{\Crypt::encrypt($user_id)}}">
                    <div class="mb-3">
                        <label class="form-label email-text-heading">Password<span class="text-light">*</span></label>
                        <input type="password" name="password" id="password" placeholder="PASSWORD" class="form-control input-login-main" required="" data-parsley-minlength="8" data-parsley-pattern="(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z]).*" data-parsley-pattern-message="Your password must be a minimum of 8 characters long and include at least 1 lowercase and 1 uppercase letter and 1 number.">
                    </div>
                    <div class="mb-3">
                        <label class="form-label email-text-heading">Confirm Password<span class="text-light">*</span></label>
                        <input type="password" name="cpassword" id="cpassword" placeholder="CONFIRM PASSWORD" class="form-control input-login-main" required=""  data-parsley-equalto="#cpassword" data-parsley-required-message="Confirm password should match password field.">
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="sign-up-btn-main">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{ asset('plugins/parsley/parsley.js') }}"></script>
@endsection

