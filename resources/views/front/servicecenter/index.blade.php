@extends('front.layout.main')
@section('content')
<div class="service-inner-tophead">
    <img src="{{asset('public/uploads/servicecenterdetail/ACR-banner (1).jpg')}}" class="img-fluid" alt="" title="">
    <div class="service-inner-tophead-text">
        <h2>{{ strtoupper($site_title) }}</h2>
        <ul class="shop-center-breadcum">
            <li><a href="{{url('/')}}">Home</a></li>
            <li><i class="fa-solid fa-angles-right"></i></li>
            <li>{{ $site_title }}</li>
        </ul>
    </div>
</div>

{{-- <div class="shop-center-sec-main">
    <div class="container">
        @if($service_center->count())
            @foreach($service_center as $record)
                <div class="shop-center-bg">
                    <div class="row">
                        <div class="col-12 col-md-6 ">
                            <img src="{{asset('public/uploads/servicecenterdetail/'.$record->image)}}" class="img-fluid service-center-image" alt="" title="{{$record->image_title}}">
                        </div>
                        <div class="col-12 col-md-6 shop-address-main">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h3>{{ $record->name }}</h3>
                                </div>
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
            @endforeach
        @endif
    </div>
</div> --}}


<div class="new-locations">
    <div class="container">
        <div class="location-banner">
            <img src="" alt="">
        </div>

        <div class="location-cards">
            <div class="location-card-parent">
                <div class="location-one">
                    <a href="{{url('/auto-car-repair-gurgaon.blade.php')}}">
                        <div class="location-card-one">
                            <img src="{{asset('public/uploads/servicecenterdetail/location.png')}}" alt="" width="16%">

                            <h3>Gurgaon</h3>
                        </div>
                    </a>
                </div>

                <div class="location-one">
                    <a href="">
                        <div class="location-card-one">
                            <img src="{{asset('public/uploads/servicecenterdetail/location.png')}}" alt="" width="16%">

                            <h3>Motinagar Area</h3>
                        </div>
                    </a>
                </div>

                <div class="location-one">
                    <a href="">
                        <div class="location-card-one">
                            <img src="{{asset('public/uploads/servicecenterdetail/location.png')}}" alt="" width="16%">

                            <h3>South Delhi (Okhla)</h3>
                        </div>
                    </a>
                </div>

                <div class="location-one">
                    <a href="">
                        <div class="location-card-one">
                            <img src="{{asset('public/uploads/servicecenterdetail/location.png')}}" alt="" width="16%">

                            <h3>Faridabad</h3>
                        </div>
                    </a>
                </div>

                <div class="location-one">
                    <a href="">
                        <div class="location-card-one">
                            <img src="{{asset('public/uploads/servicecenterdetail/location.png')}}" alt="" width="16%">

                            <h3>Sonipat</h3>
                        </div>
                    </a>
                </div>

                <div class="location-one">
                    <a href="">
                        <div class="location-card-one">
                            <img src="{{asset('public/uploads/servicecenterdetail/location.png')}}" alt="" width="16%">

                            <h3>Noida</h3>
                        </div>
                    </a>
                </div>

                <div class="location-one">
                    <a href="">
                        <div class="location-card-one">
                            <img src="{{asset('public/uploads/servicecenterdetail/location.png')}}" alt="" width="16%">

                            <h3>Ghaziabad</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>









@endsection



