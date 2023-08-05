@extends('front.layout.main')
@section('content')
<div class="shop-center-tophead">
    <img src="{{ asset('front/img/service-inner-bg.png') }}" class="img-fluid" alt="">
    <div class="shop-center-text">
        <h2>{{ strtoupper($site_title) }}</h2>
        <ul class="shop-center-breadcum">
            <li><a href="{{url('/')}}">Home</a></li>
            <li><i class="fa-solid fa-angles-right"></i></li>
            <li>{{ $site_title }}</li>
        </ul>
    </div>
</div>

<div class="shop-center-sec-main">
    <div class="container">
        <div class="shop-center-bg">
            <div class="row">
            <div class="col-12 text-center">
                <h3>{{ $record->name }}</h3>
            </div>
                <div class="col-12 col-md-6 ">
                    <img src="{{asset('public/uploads/servicecenterdetail/'.$record->image)}}" class="img-fluid" alt="">
                </div>
                <div class="col-12 col-md-6 shop-address-main">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                            <div class="address-main">
                                <i class="fa-solid fa-location-dot"></i>
                                <p> {{$record->address}} </p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                            <div class="call-main">
                                <i class="fa-solid fa-phone"></i>
                                <a href="tel:{{$record->phone_number}}"> {{$record->phone_number}} </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection