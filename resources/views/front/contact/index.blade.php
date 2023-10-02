@extends('front.layout.main')
@section('content')
<!-- contact-us page start  -->
<div class="contact-section-main">
    <div class="container">
        <div class="contact-main-heading">
            <h1>Leave us a message!</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="contact-helpnumber-main">
                    <h2>Helpline Numbers</h2>
                    <a href="tel:{{$phone}}">{{$phone}}</a>
                    <img src="{{ asset('front/img/cant-old-phone.png') }}"  alt="">
                </div>
                <div class="contact-helpnumber-main">
                    <h2>Email</h2>
                    <a href="mailto:{{$email}}">{{$email}}</a>
                    <img src="{{ asset('front/img/cont-emil.png') }}"  alt="">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="address-main-contact">
                    <h2>Corporate Office Address</h2>
                    <p>{!! $address !!}</p>
                    <img src="{{ asset('front/img/address-sec.png') }}" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </div>
</div>    
<!-- contact-us page end -->
@endsection