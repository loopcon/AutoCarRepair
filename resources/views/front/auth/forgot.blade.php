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
                <div class="card">
                    <div class="card-body">
                        <div class="m-sm-4">
                            <form method="post" action="{{route('front_forgot-password')}}" id="login-form" enctype="multipart/form-data" data-parsley-validate=''>
                                {{ csrf_field() }} 
                                <div class="mb-3">
                                    <label class="form-label">Email<span class="text-danger">*</span></label>
                                    <input type="email" name="email" placeholder="EMAIL ID" required="" class="form-control ">
                                </div>
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
             </div>
        </div>
    </div>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('javascript')
<script src="{{ asset('plugins/parsley/parsley.js') }}"></script>
@endsection

