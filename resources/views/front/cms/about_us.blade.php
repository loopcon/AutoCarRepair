@extends('front.layout.main')
@section('content')
<!-- about section start  -->
<div class="container">
    <div class="about-main-sec">
        <h1>{{ strtoupper($site_title) }}</h1>
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