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

<div class="forget-section-main">
    <div class="container">
        <div class="row justify-content-center">
            <div class=" col-lg-6">
                 <form method="post" action="{{route('front_forgot-password')}}" id="login-form" enctype="multipart/form-data" data-parsley-validate=''>
                    {{ csrf_field() }} 
                    <div class="mb-3">
                        <label class="form-label email-text-heading">Email<span class="text-light">*</span></label>
                        <input type="email" name="email" placeholder="EMAIL ID" required="" class="form-control input-login-main">
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="sign-up-btn-main">Submit</button>
                    </div>
                </form>
             </div>
        </div>
    </div>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('javascript')
<script src="{{ asset('plugins/parsley/parsley.js') }}"></script>
@endsection

