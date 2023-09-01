@extends('front.layout.main')
@section('content')
<!-- contact-us page start  -->
<?php /* <div class="contact-section-main">
    <div class="container page-content">
        <div class="row">
            <div class="col-12 mx-auto my-lg-5 my-md-5 my-sm-3 my-3">
                <div class="pt-lg-4 pt-md-4 pt-sm-3 pt-3">
                    <h3 class="text-center page-head">{{$site_title}}</h3>
                </div>
            </div>
        </div>
    </div>
</div> */ ?>
<!-- contact-us page end -->

<div class="cms-section-main">
    <img src="{{ asset('front/img/cms-banner-img.webp') }}" class="cms-image-main" alt="" title="Testimotionals">
    <div class="cms-section-text">
        <h2>MUFFLER AND EXHAUST SERVICE</h2>
        <a class="Request-appointmentbtn" href="#">Book A Service</a>
    </div>
</div>
<div class="container">
    <div class="cms-form-text-sec">
        <div class="row">
            <div class="col-12  col-md-6 col-lg-8">
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here'</p>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here'
                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here''</p>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here'</p>
                <button class="book-service-cms">Book A Service</button>
            </div>
            <div class="col-12 col-md-6 col-lg-4 p-0 ">
                <div class="cms-page-section">
                    <h3 class="request-heading-main">Request an Appointment</h3>
                    <form action="">
                        <div class="mb-3">
                            <input type="text" class="form-control cms-email-input" id="exampleInputEmail1" placeholder="Enter Your Name" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control cms-email-input" id="exampleInputEmail1" placeholder="Enter Your Email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <input type="tel" class="form-control cms-email-input" id="exampleInputEmail1" placeholder="Enter Your Phone Number" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label  class="form-label email-label">Message</label>
                            <textarea class="form-control cms-email-input" id="textAreaExample" rows="1"></textarea>
                        </div>
                        <a href="javascript:void(0)" class="btn send-otp-main" id="send_otp">SEND OTP </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection