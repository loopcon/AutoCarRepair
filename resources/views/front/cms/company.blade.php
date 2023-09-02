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
    @if(isset($compnypageInfo->banner_image) && $compnypageInfo->banner_image)
        <img src="{{url('uploads/compnycms/'.$compnypageInfo->banner_image)}}" class="cms-image-main" alt="" title="{{isset($compnypageInfo->image_title) ? $compnypageInfo->image_title : ''}}">
    @endif
    <div class="cms-section-text">
        <h2>{{ isset($compnypageInfo->banner_text) ? $compnypageInfo->banner_text : '' }}</h2>
        <a class="Request-appointmentbtn apt-btn" href="javascript:void(0)">Book A Service</a>
    </div>
</div>
<div class="container">
    <div class="cms-form-text-sec">
        <div class="row">
            <div class="col-12  col-md-6 col-lg-8">
                <p>{!! isset($compnypageInfo->description) ? $compnypageInfo->description : '' !!}</p>
                <!-- <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here'
                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here''</p>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here'</p> -->
                <button class="book-service-cms apt-btn">Book A Service</button>
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
<!-- Appointment select modal -->  
<div class="modal fade" id="appointmentselectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog appointmentselect-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <h1>Select Brand</h1>
                    <div class="input-group">
                        <input type="text" class="form-control search-brand-input" id="search_brand" placeholder="Search Brand"  aria-label="Amount (to the nearest dollar)">
                        <div class="search-icon">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                    </div>
                    <div class="row m-0" id="amodal_brands">
                        @php($brands = getbrands())
                        @if($brands->count())
                            @foreach($brands as $brand)
                                @if($brand->image)
                                    <div class="col-4 brand-logo-center">
                                        <a href="javascript:void(0);" class="amodal-brand" data-id="{{$brand->id}}"><img src="{{ asset('public/uploads/carbrand/'.$brand->image) }}" class="img-fluid" alt=""></a>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- Appointment select modal -->
<!-- Appointment search modal -->
<div class="modal fade" id="appointmentsearchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog appointmentsearch-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <h1>Select Model</h1>
                    <div class="input-group">
                        <input type="text" class="form-control search-brand-input" id="search_model" placeholder="Search Model"  aria-label="Amount (to the nearest dollar)">
                        <div class="search-icon">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                    </div>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#appointmentselectModal">Change</a>
                    <div class="row m-0 search-modal-box" id="amodal_models">

                    </div>
                </div>
            </div>
            <div class="modal-footer"> </div>
        </div>
    </div>
</div>
<!-- Appointment search modal -->
<!-- Appointment fuel modal -->
<div class="modal fade" id="appointmentfuelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog appointmentfuel-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div>
                <h1>Select Fuel Type </h1>
                <div class="input-group">
                    <input type="text" class="form-control search-brand-input" id="search_fuel" placeholder="Search Fuel"  aria-label="Amount (to the nearest dollar)">
                    <div class="search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#appointmentselectModal">Change</a>
                <div class="row m-0 search-modal-box" id="amodal_fuels">
                </div>
            </div>
        </div>
        <div class="modal-footer"> </div>
    </div>
</div>
</div>
<!-- Appointment fuel modal -->
<!-- Appointment Number modal -->
<div class="modal fade" id="appointmentnumberModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog appointmentnumber-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <h1>Get instant quotes for your car service </h1>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#appointmentselectModal">Change</a>
                    <div class="row m-0 search-modal-box" id="search_info">

                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control num_only" maxlength="10"  id="appointmentmobile" name="mobile" aria-describedby="emailHelp" placeholder="Enter Phone Number">
                    </div>
                </div>
                <div class="aptotp-section">
                    <div class="mb-3 otpinput-main">
                        <input type="text" class="form-control num_only" maxlength="4" id="appointmentotp" name="otp" aria-describedby="emailHelp" placeholder="OTP">
                        <div id="appointmentresend_text"><b>Resend OTP in <span id="apttimer"></span> seconds</b></div>
                    </div>
                    <!--<a href="javascript:void(0)" id="verify_otp" class="btn verify-otpbtn">VERIFY OTP </a>-->
                    <a href="javascript:void(0)" id="appointmentresend_otp" class="bookservice-resend-otp">RESEND OTP </a>
                </div>
                <input type="hidden" id="appointmentis_otp_verify" value="0">
                <a href="javascript:void(0)" class="btn check-price-btn mt-3" id="appointmentsend_otp">SEND OTP </a>

            </div>
            <div class="modal-footer">
                <a class="check-price-btn-main" id="check_price" href="javascript:void(0);"><button type="button"  class="check-price-btn" >Check Price For Free </button></a>
            </div>
        </div>
    </div>
</div>
<!-- Appointment Number modal -->

@endsection