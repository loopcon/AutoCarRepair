@extends('front.layout.main')
@section('content')
<!-- contact-us page start  -->
<?php /* <div class="contact-section-main">
    <div class="container page-content">
        <div class="row">
            <div class="col-12 mx-auto my-lg-5 my-md-5 my-sm-3 my-3">
                <div class="pt-lg-4 pt-md-4 pt-sm-3 pt-3">
                    <h3 class="text-center page-head">{{$site_title}}</h3>
                    <div class="card-body pt-lg-3 pt-md-0 pt-sm-0 pt-0">
                       <p>{!! isset($pageInfo->description) ? $pageInfo->description : '' !!}</p> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> */ ?>    
<!-- contact-us page end -->
<!-- about section start  -->
<div class="container">
    <div class="about-main-sec">
        <h1>ABOUT US</h1>
        <p class="about-text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here'</p>
    </div>
    <div class="row align-items-center about-image-text-main">
        <div class="col-12 col-sm-6">
            <div>
                <img src="{{ asset('front/img/about-img.png') }}" class="img-fluid" alt="">
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <h4>PEOPLE</h4>
            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here'
                <br>
               It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here''</p>
        </div>

    </div>
</div>
<!-- about brand logo  slider start  -->
<div class="aboutus-logo-section">
    <div class="container">
        <div id="aboutus-brand-carousel" class="owl-carousel owl-theme">
            <div class="item">
                <div class="about-partner-brand-logo">
                    <img src="img/livguard_logo.png"  alt="">
                </div>
            </div>
            <div class="item">
                <div class="about-partner-brand-logo">
                    <img src="img/denso_logo.png"  alt="">
                </div>
            </div>
            <div class="item">
                <div class="about-partner-brand-logo">
                    <img src="img/castrol_logo.png"  alt="">
                </div>
            </div>
            <div class="item">
                <div class="about-partner-brand-logo">
                    <img src="img/Asianppg_logo.png"  alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- about brand logo  slider end -->
<!-- about section  end -->

@endsection