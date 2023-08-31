@extends('front.layout.main')
@section('css')
    <link class="js-stylesheet" href="{{ asset('plugins/parsley/parsley.css') }}" rel="stylesheet">
@endsection
@section('content')
<!-- slider section  start  -->
<div class="acr-slider-section-main">
    <div class="container">
        <div class="acr-slider-section-main">
            <div class="row m-0">
                <div class="col-12 col-md-6 slider-section-box">
                    <div class="slider-section-main">
                        <h2>{{ isset($hsetting->section1_title1) ? $hsetting->section1_title1 : ''}} </h2>
                        <h5>{{ isset($hsetting->section1_title2) ? $hsetting->section1_title2 : ''}}</h5>
                        <p>{{ isset($hsetting->section1_description) ? $hsetting->section1_description : ''}}</p>
                        <a class="get-service-btn apt-btn" href="javascript:void(0);">Get Service</a>
                        <!-- <button>Get Service</button> -->
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div>
                        <img src="{{ isset($hsetting->section1_image) && $hsetting->section1_image ? asset('uploads/content/'.$hsetting->section1_image) : asset('front/img/slider-image.png') }}" class="img-fluid" alt="" title="{{ isset($hsetting->image_title) ? $hsetting->image_title : ''}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider section  end -->

<!-- slider down service start  -->
<div class="container">
    <div class="service-section">
        <div>
            <a href="{{url('our-services')}}" class="service-main-btn">Services</a>
        </div>
        <div class="always-service-text">
            <p>We Always Ready to Serve You the Best Service</p>
        </div>
        <div class="row m-0">
            @if($scategories->count())
                @php($key = 0)
                @foreach($scategories as $sk => $service)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="{{url($service->slug)}}">
                            <div class="services-cate-main services-cate-common{{$key}}">
                                <div class="car-service-img-main">
                                    @if(isset($service->image) && $service->image)
                                        <img src="{{ asset('uploads/service/category/'.$service->image) }}" class="img-fluid" alt="" title="{{$service->title}}" />
                                    @else
                                        <img src="{{ asset('front/img/no_image.jpg') }}" class="img-fluid" alt="">
                                    @endif
                                </div>
                                <div class="services-cate-item" >
                                    <img src="{{ asset('uploads/service/category/icon/'.$service->icon_image) }}" class="service-cat-smallimg" alt="" title="{{$service->title}}">
                                    <div class="home-service-main"> <h4> {{$service->title}} </h4> </div>
                                    <?php /* <p >We are always help to make one of the best adjustment service </p>
                                    <img src="{{ asset('front/img/ser-cat'.$img.'big.png') }}" class="se-cat-bigimage" alt="" title="{{$service->title}}"> */ ?>
                                </div>
                            </div>
                        </a>
                    </div>
                @php($key++)
                @if($key == 6)
                    @php($key = 0)
                @endif
                @endforeach
            @endif
        </div>
    </div>       
</div>
<!-- slider down service end  -->

<!-- why choose us start  -->
    <div class="why-choose-section">
        <div class="container">
            <div class="row m-0 why-choose-box-main">
                <div class="col-12 col-md-6">
                    <div class="why-choose-img-main">
                        <img src="{{ asset('front/img/advance-service-main.webp') }}" class="img-fluid" alt="" title="Why Choose Us">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="why-choose-main">
                        <div class="why-choose-item">
                            <h4>Why Choose Us?</h4>
                            <h5> Why Choose Auto Car Repair Service?</h5>
                            <p>Our goal is to ensure that every customer’s satisfaction is guaranteed. We 
                                have a range of highly skilled technicians who can perform work on a 
                                variety of makes and models.</p>    
                        </div>
                        <div class="row m-0">
                            <div class="col-12 col-sm-6"> 
                                <div class="why-choose-inner-item">
                                    <img src="{{ asset('front/img/why-mechanic.webp') }}" class="img-fluid" alt="" title="car repair service">
                                    <h4>Skilled Technicians</h4>
                                    <p>We want to get you in and out quickly while providing you top notch auto repair service in Delhi.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="why-choose-inner-item">
                                    <img src="{{ asset('front/img/why-qualservice.webp') }}" class="img-fluid" alt="" title="car repair service">
                                    <h4>Quality Services</h4>
                                    <p>We take pride in offering you the best services available and 100% Satisfaction Guarantee.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="why-choose-inner-item">
                                    <img src="{{ asset('front/img/why-car-insurance.webp') }}" class="img-fluid" alt="" title="">
                                    <h4>Cashless Insurance Claims</h4>
                                    <p>We take pride in offering you the best services available and 100% Satisfaction Guarantee.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="why-choose-inner-item">
                                    <img src="{{ asset('front/img/why-car-parts.webp') }}" class="img-fluid" alt="" title="">
                                    <h4>100% OEM Genuien Parts</h4>
                                    <p>We want to get you in and out quickly while providing you top notch auto repair service in Delhi.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- why choose us end  -->
<!-- offer section  start  -->
<div class="offeer-section">
    <div>
        <div id="offer-carousel" class="owl-carousel ">
            @if($offer_slider->count())
                @foreach($offer_slider as $slider)
                <div class="item">
                    <div class="offer-section-main">
                        <img class="img-fluid" src="{{ asset('uploads/offerslider/'.$slider->image) }}"  alt="" title="{{ isset($slider->image_title) ? $slider->image_title : ''}}">
                        <div class="offer-section-item">
                            <div class="container">
                                <p>{{$slider->title1}}</p>
                                <h4>{{$slider->title2}}</h4>
                                <a href="{{url('our-services')}}" target="_blank" ><button class="explore-btn">{{$slider->btn_title}}</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif  
        </div>
    </div>
</div> 
<!-- offer section  start  -->
<!-- testimonial start  -->
<div class="testimonial-section">
    <div class="container">
        <div class="row m-0">
            <div class="col-12 col-md-6">
                <div class="row  m-0 testiminoal-img-main">
                    <div class="col-12 col-sm-6 col-md-12 col-lg-6 testiminoal-img-item">
                        <img src="{{ asset('front/img/testiminoal-img.webp') }}" class="img-fluid" alt="" title="Testimonials">
                    </div>
                    <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                        <div class="testiminoal-img-main-text">
                            <p>Testimonials</p>
                            <h4>What our customers are saying</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 testiminoal-carousel-sec-main">
                <div id="testiminoal-carousel" class="owl-carousel owl-theme">
                    <div class="item">
                       <div >
                            <div class="star-group-icon">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="test-slider-text">
                                <p>“The people at ACR are AMAZING. Their prices are more than fair and they work quickly. I had an instance…”</p>
                            </div>
                            <div class="test-rating-sec-main">   
                                <div>
                                    <div class="test-rating-main">
                                        <img src="{{ asset('front/img/alon-musk-img.png') }}" class="img-fluid" alt="" title="">
                                    </div>
                                </div>  
                                <div class="test-rating-sec-item">
                                    <span>Elon Musk</span>
                                    <p>10 April 2023</p>
                                </div>
                            </div>
                       </div>
                    </div>
                    <div class="item">
                        <div >
                            <div class="star-group-icon">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="test-slider-text">
                                <p>“The people at ACR are AMAZING. Their prices are more than fair and they work quickly. I had an instance…”</p>
                            </div>
                            <div class="test-rating-sec-main">   
                                <div>
                                    <div class="test-rating-main">
                                        <img src="{{ asset('front/img/alon-musk-img.png') }}" class="img-fluid" alt="" title="">
                                    </div>
                                </div>  
                                <div class="test-rating-sec-item">
                                    <span>Elon Musk</span>
                                    <p>10 April 2023</p>
                                </div>
                            </div>
                       </div>
                    </div>
                    <div class="item">
                        <div >
                            <div class="star-group-icon">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="test-slider-text">
                                <p>“The people at ACR are AMAZING. Their prices are more than fair and they work quickly. I had an instance…”</p>
                            </div>
                            <div class="test-rating-sec-main">   
                                <div>
                                    <div class="test-rating-main">
                                        <img src="{{ asset('front/img/alon-musk-img.png') }}" class="img-fluid" alt="" title="">
                                    </div>
                                </div>  
                                <div class="test-rating-sec-item">
                                    <span>Elon Musk</span>
                                    <p>10 April 2023</p>
                                </div>
                            </div>
                       </div>
                    </div>
                    <div class="item">
                        <div >
                            <div class="star-group-icon">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="test-slider-text">
                                <p>“The people at ACR are AMAZING. Their prices are more than fair and they work quickly. I had an instance…”</p>
                            </div>
                            <div class="test-rating-sec-main">   
                                <div>
                                    <div class="test-rating-main">
                                        <img src="{{ asset('front/img/alon-musk-img.png') }}" class="img-fluid" alt="" title="">
                                    </div>
                                </div>  
                                <div class="test-rating-sec-item">
                                    <span>Elon Musk</span>
                                    <p>10 April 2023</p>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- testimonial end  -->
<!-- brand logo  slider start  -->
<div class="brand-logo-section">
    <div class="container">
        <div id="partner-brand-carousel" class="owl-carousel owl-theme">
            @if($brand_logo_slider->count())
                @foreach($brand_logo_slider as $record)
                    <div class="item">
                        <div class="partner-brand-logo">
                            <img src="{{ asset('uploads/brandlogoslider/'.$record->image) }}"  alt="" title="{{$record->image_title}}">
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
<!-- brand logo  slider end -->
<!-- save more start  -->
<div class="save-more-section">
    <div class="container">
        <div class="row m-0">
            <div class="col-12 col-md-10 col-lg-6">
                <div class="save-more-text">
                    <p>Save More With Our Ongoing Offers</p>
                </div>
            </div>
            <div class="col-12  col-lg-6 save-more-img-main">
                <div class="save-more-img">
                    <img  class="img-fluid"  src="{{ asset('front/img/cont-blue-toyota.webp') }}" alt="" title=" Ongoing Offers">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- save more end  -->
<!-- form section start  -->
<div class="form-section-bg">
    <div class="container">
        <div class="request-text-main">
            <h3 class="owText">Contact Us</h3>
            <h2>Request an Appointment</h2>     
            <p>After you submit the form, a representative will call you back with the information you’ll need to make an appointment.</p>
        </div>
        <form method="POST" action="{{route('front_appointment-store')}}" id="appointment-form" enctype="multipart/form-data" data-parsley-validate="">
            @csrf
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">YOUR NAME</label>
                            <input type="text" class="form-control home-email-input" id="name" name="name" required="" placeholder="Enter Your Name" aria-describedby="nae">
                            @if ($errors->has('name')) <div class="text-warning">{{ $errors->first('name') }}</div>@endif
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">YOUR PHONE</label>
                            <input type="text" class="form-control num_only home-email-input" id="mobile" maxlength="10" name="phone" placeholder="Enter Your Phone Number" aria-describedby="nae">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">YOUR EMAIL</label>
                            <input type="email" class="form-control home-email-input" id="email" required="" name="email" placeholder="Enter Your Email" aria-describedby="emailHelp">
                            @if ($errors->has('email')) <div class="text-warning">{{ $errors->first('email') }}</div>@endif
                        </div>
                        <?php /*<div class="mb-5">
                            <label for="exampleInputEmail1" class="form-label">YOUR SERVICE</label>
                            <select class="request-select-box" id="service" required="" name="service" aria-label="Default select example">
                                <option selected disabled>Open this select menu </option>
                                @foreach($scategories as $value)
                                    <option value="{{$value->id}}" {{isset($scategories->id) && $scategories->id == $value->id ? 'selected' : (old('id') && old('id') == $value->id ? 'selected' : '')}}>{{$value->title}}</option>
                                @endforeach
                                <!-- <option value="2">Two</option>
                                <option value="3">Three</option> -->
                            </select>
                            @if ($errors->has('service')) <div class="text-warning">{{ $errors->first('service') }}</div>@endif
                        </div> */ ?>
                        <div class="form-group mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">YOUR MESSAGE</label>
                            <textarea class="form-control home-email-input" id="message" name="message" rows="1" required=""></textarea>
                            @if ($errors->has('message')) <div class="text-warning">{{ $errors->first('message') }}</div>@endif
                        </div>
                    </div>
                </div>
                @if (session()->has('success'))
                    <div class="msg-success">
                        <h6>Thanks for Enquery, our Customer care represent will contact you soon.</h6>
                    </div>
                @endif
                <input type="submit" class="form-btn-contant" id="send_message" value="Send Message">

                <div class="otp-section">
                    <div class="mb-3 otpinput-main">
                        <input type="text" class="form-control num_only" id="otp" name="otp" aria-describedby="emailHelp" placeholder="OTP">
                        <div class="text-white" id="resend_text"><b>Resend OTP in <span id="timer"></span> seconds</b></div>
                    </div>
                    <!--<a href="javascript:void(0)" id="verify_otp" class="btn verify-otpbtn">VERIFY OTP </a>-->
                    <a href="javascript:void(0)" id="resend_otp" class="btn form-btn-contant">RESEND OTP </a>
                </div>
                <input type="hidden" id="is_otp_verify" value="0">
                <a href="javascript:void(0)" class="btn form-btn-contant" id="send_otp">SEND OTP </a>
            </form>
    </div>
</div>
<!-- form section end  -->
<!--service center section start -->
<div class="container choose-service-centersection">
    <div id="choose-service-center" class="owl-carousel owl-theme">
        @if($service_center->count())
            @foreach($service_center as $detail)
                <div class="item">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#servicecenterModal-{{$detail->id}}"><img src="{{ asset('uploads/servicecenterdetail/'.$detail->image) }}" class="service-center-slider-img detail" alt="" title="{{$detail->image_title}}"></a>
                </div>
            @endforeach
        @endif        
    </div>
    @if($popup_detail->count())
        @foreach($popup_detail as $detail)
            <!-- Modal -->
            <div class="modal fade" id="servicecenterModal-{{$detail->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog servicecenter-dailog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <img src="{{ asset('uploads/servicecenterdetail/'.$detail->image) }}" class="service-center-popupimg" alt="" title="{{$detail->image_title}}"> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="servicecenteraddress-main">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <p>{{$detail->address}}</p>
                                </div>
                                <div class="servicecenter-call-main">
                                    <i class="fa-solid fa-phone"></i>
                                    <a href="#">{{$detail->phone_number}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    @if(isset($hsetting->price_list) && $hsetting->price_list)
        <div class="container">
            <div class="col-12">
                <h3>Car Services Price List in NCR, Delhi 2023</h3>
            </div>
            {!! $hsetting->price_list !!}
        </div>
    @endif
</div>
<!--service center section end -->
@endsection
@section('javascript')
<script src="{{ asset('plugins/parsley/parsley.js') }}"></script>
<script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
<script>
$(document).ready(function(){
        $('#offer-carousel').owlCarousel({
            loop: true,
            margin: 30,
            dots: false,
            nav: true,
            items: 1,
        });
        $('#testiminoal-carousel').owlCarousel({
            loop: true,
            margin: 30,
            dots: true,
            nav: false,
            items: 1,
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:true
        });
        $('#partner-brand-carousel').owlCarousel({
            loop: true,
            margin: 30,
            dots: false,
            nav: false,
            items: 4,
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
            responsiveClass: true,
            responsive: {
            0: {
            items: 1
            },
            450:{
            items: 2
            },
            600: {
            items: 3
            },

            1024: {
            items: 4
            }
        }

        });
        $('#choose-service-center').owlCarousel({
            loop: true,
            margin: 30,
            dots: false,
            nav: true,
            items: 4,
            responsiveClass: true,
            responsive: {
                0: {
                items: 1
                },
                450:{
                items: 2
                },
                600: {
                items: 3
                },
                1024: {
                items: 4
                }
            }
        });

    $('#resend_otp').hide();
    $('.otp-section').hide();
    $('#send_message').hide();
    $(document).on('click', '#send_otp', function(){
        var validateMobNum= /[1-9]{1}[0-9]{9}/;
        var mobile = $('#mobile').val();
        if (validateMobNum.test(mobile) && mobile.length == 10) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url : '{{ route('front_send-otp') }}',
                method : 'post',
                data : {_token: CSRF_TOKEN, mobile:mobile},
                success : function(result){
                    var result = $.parseJSON(result);
                    if(result.result == 'success'){
                        $("#mobile").attr("readonly", "readonly");
                        $('.otp-section').show();
                        $('#send_otp').hide();
                        timer(30);
                    } else {
                        toastr.error('Something went wrong. Please try again later!');
                    }
                }
            });
        }
        else {
            toastr.error('Please Enter Valid Mobile No.');
        }
    });

    $(document).on('keyup', '#otp', function(){
        var mobile = $('#mobile').val();
        var otp = $('#otp').val();
        var olength = otp.toString().length;
        if(parseInt(olength) > 3){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url : '{{ route('front_verify-otp') }}',
                method : 'post',
                data : {_token: CSRF_TOKEN, mobile:mobile, otp:otp},
                success : function(result){
                    var result = $.parseJSON(result);
                    if(result.result == 'success'){
//                        $('#verify_otp').hide();
                        $('#resend_text').hide();
                        $('#is_otp_verify').val('1');
                        $('#send_message').show();
                        $("#mobile").attr("readonly", "readonly"); 
                        $('#otp').hide();
                    } else {
                        toastr.error('Please Enter Valid OTP.');
                    }
                }
            });
        }
    });

    $(document).on('click', '#resend_otp', function(){
        var validateMobNum= /[1-9]{1}[0-9]{9}/;
        var mobile = $('#mobile').val();
        if (validateMobNum.test(mobile) && mobile.length == 10) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url : '{{ route('front_resend-otp') }}',
                method : 'post',
                data : {_token: CSRF_TOKEN, mobile:mobile},
                success : function(result){
                    var result = $.parseJSON(result);
                    if(result.result == 'success'){
                        console.log('test');
                        $('.otp-section').show();
//                        $('#verify_otp').show();
                        $('#resend_text').show();
                        $('#otp').val('');
                        $('#otp').show();
                        $("#mobile").attr("readonly", "readonly");
                        $('#resend_otp').hide();
                        timer(30);
                    } else {
                        toastr.error('Something went wrong. Please try again later!');
                    }
                }
            });
        }
        else {
            toastr.error('Please Enter Valid Mobile No.');
        }
    });
});
let timerOn = true;
        function timer(remaining) {
            var m = Math.floor(remaining / 60);
            var s = remaining % 60;
            m = m < 10 ? '0' + m : m;
            s = s < 10 ? '0' + s : s;
            document.getElementById('timer').innerHTML = m + ':' + s;
            remaining -= 1;
            if(remaining >= 0 && timerOn) {
              setTimeout(function() {
                  timer(remaining);
              }, 1000);
              return;
            }

            if(!timerOn) {
              // Do validate stuff here
              return;
            }
            // Do timeout stuff here
            var is_otp_verify = $('#is_otp_verify').val();
            if(is_otp_verify == '0'){
                $('#resend_otp').show();
                $("#mobile").removeAttr("readonly"); 
//                $('#verify_otp').hide();
                $('#resend_text').hide();
                $('#otp').hide();
            }
        }
    // if ( getElementById( 'name' ) == null )
    // {
    //     function onFocus() {
    //         document.getElementById( 'name' ).innerHTML = '<b>' + this.name + ' is focused </b>';
    //     }
    // }
</script>
@endsection