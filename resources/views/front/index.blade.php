@extends('front.layout.main')
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
                        <button>Get Service</button>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div>
                        <img src="{{ isset($hsetting->section1_image) && $hsetting->section1_image ? asset('uploads/content/'.$hsetting->section1_image) : asset('front/img/slider-image.png') }}" class="img-fluid" alt="">
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
            <a class="service-main-btn">Services</a>
        </div>
        <div class="always-service-text">
            <p>We Always Ready to Serve You the Best Service</p>
        </div>
        <div class="row m-0">
            @if($scategories->count())
                @php($key = 0)
                @foreach($scategories as $service)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="services-cate-main services-cate-common{{$key}}">
                            <div class="car-service-img-main">
                                @if(isset($service->image) && $service->image)
                                    <img src="{{ asset('uploads/service/category/'.$service->image) }}" class="img-fluid" alt="">
                                @else
                                    <img src="{{ asset('front/img/no_image.jpg') }}" class="img-fluid" alt="">
                                @endif
                            </div>
                            <div class="services-cate-item">
                                @php($img = $key + 1)
                                <img src="{{ asset('front/img/ser-cat'.$img.'small.png') }}" class="img-fluid" alt="">
                                <h4> {{$service->title}} </h4>
                                <p>We are always help to make one of the best adjustment service </p>
                            </div>
                        </div>
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
                        <img src="{{ asset('front/img/advance-service-main.png') }}" class="img-fluid" alt="">
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
                                    <img src="{{ asset('front/img/why-mechanic.png') }}" class="img-fluid" alt="">
                                    <h4>Skilled Technicians</h4>
                                    <p>We want to get you in and out quickly while providing you top notch auto repair service in Delhi.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="why-choose-inner-item">
                                    <img src="{{ asset('front/img/why-qualservice.png') }}" class="img-fluid" alt="">
                                    <h4>Quality Services</h4>
                                    <p>We take pride in offering you the best services available and 100% Satisfaction Guarantee.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="why-choose-inner-item">
                                    <img src="{{ asset('front/img/why-car-insurance.png') }}" class="img-fluid" alt="">
                                    <h4>Cashless Insurance Claims</h4>
                                    <p>We take pride in offering you the best services available and 100% Satisfaction Guarantee.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="why-choose-inner-item">
                                    <img src="{{ asset('front/img/why-car-parts.png') }}" class="img-fluid" alt="">
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
            <div class="item">
                <div class="offer-section-main">
                    <img src="{{ asset('front/img/slider-Offers.png') }}"  alt="">
                    <div class="offer-section-item">
                        <div class="container">
                            <p>EXCLUSIVE MONTHLY OFFER</p>
                            <h4>UPTO 20% DISCOUNT FOR ALL BRAND SERVICE</h4>
                            <button class="explore-btn"> Explore More</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="offer-section-main">
                    <img src="{{ asset('front/img/slider-Offers.png') }}"  alt="">
                    <div class="offer-section-item">
                        <div class="container">
                            <p>EXCLUSIVE MONTHLY OFFER</p>
                            <h4>UPTO 20% DISCOUNT FOR ALL BRAND SERVICE</h4>
                            <button class="explore-btn"> Explore More</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="offer-section-main">
                    <img src="{{ asset('front/img/slider-Offers.png') }}"  alt="">
                    <div class="offer-section-item">
                        <div class="container">
                            <p>EXCLUSIVE MONTHLY OFFER</p>
                            <h4>UPTO 20% DISCOUNT FOR ALL BRAND SERVICE</h4>
                            <button class="explore-btn"> Explore More</button>
                        </div>
                    </div>
                </div>
            </div>
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
                        <img src="{{ asset('front/img/testiminoal-img.png') }}" class="img-fluid" alt="">
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
                                        <img src="{{ asset('front/img/alon-musk-img.png') }}" class="img-fluid" alt="">
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
                                        <img src="{{ asset('front/img/alon-musk-img.png') }}" class="img-fluid" alt="">
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
                                        <img src="{{ asset('front/img/alon-musk-img.png') }}" class="img-fluid" alt="">
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
                                        <img src="{{ asset('front/img/alon-musk-img.png') }}" class="img-fluid" alt="">
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
            <div class="item">
                <div class="partner-brand-logo">
                    <img src="{{ asset('front/img/livguard_logo.png') }}"  alt="">
                </div>
            </div>
            <div class="item">
                <div class="partner-brand-logo">
                    <img src="{{ asset('front/img/denso_logo.png') }}"  alt="">
                </div>
            </div>
            <div class="item">
                <div class="partner-brand-logo">
                    <img src="{{ asset('front/img/castrol_logo.png') }}"  alt="">
                </div>
            </div>
            <div class="item">
                <div class="partner-brand-logo">
                    <img src="{{ asset('front/img/Asianppg_logo.png') }}"  alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- brand logo  slider end -->
<!-- save more start  -->
<div class="save-more-section">
    <div class="container">
        <div class="row m-0">
            <div class="col-12 col-md-10 col-lg-5">
                <div class="save-more-text">
                    <p>Save More With Our Ongoing Offers</p>
                </div>
            </div>
            <div class="col-12  col-lg-7">
                <div class="save-more-img">

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
            <h3></h3>
            <h2>Request an Appointment</h2>     
            <p>After you submit the form, a representative will call you back with the information you’ll need to make an appointment.</p>
        </div>
        <form>
            <div class="row m-0">
                <div class="col-12 col-sm-6">
                    <div class="mb-5">
                        <label for="exampleInputEmail1" class="form-label">YOUR NAME</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Your Name" aria-describedby="nae">
                    </div>
                    <div class="mb-5">
                        <label for="exampleInputEmail1" class="form-label">YOUR PHONE</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Your Phone Number" aria-describedby="nae">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="mb-5">
                        <label for="exampleInputEmail1" class="form-label">YOUR EMAIL</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Your Email" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-5">
                        <label for="exampleInputEmail1" class="form-label">YOUR SERVICE</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="form-group mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">YOUR MESSAGE</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"></textarea>
              </div>
            <button type="submit" class="form-btn-contant"> Send Message</button>
          </form>
    </div>
</div>
<!-- form section end  -->
@endsection