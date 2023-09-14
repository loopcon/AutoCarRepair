@extends('front.layout.main')
@section('content')
<div class="our-service-section">
    <div class="container">
        <div class="row">
            <div class="service-main-heading">
                <h2>Our Services</h2>
            </div>
            @if(isset($scategories) && $scategories->count())
                @foreach($scategories as $service)
                    <div class="col-12 col-sm-6 col-lg-4">
                    @php($href = $service->slug)
                        @if(in_array($service->id, $carray) && isset($brand) && isset($model) && isset($fuel))
                            @php($href = $service->slug.'/'.$brand.'/'.$model.'/'.$fuel)
                        @endif
                        <a class="servic-type-box-section" href="{{url($href)}}">
                            <div class="servic-type-box">
                            @if(!empty($service->icon_image) && isset($service->icon_image))
                                <img src="{{url('uploads/service/category/icon/'.$service->icon_image)}}" class="servic-type-box-image" alt="" title="">
                            @else
                                <img src="{{ asset('front/img/no_image.jpg') }}" class="img-fluid" alt="" title="">
                            @endif   
                            <div class="service-type-head">
                                <h4>{{ $service->title }}</h4>
                            </div> 
                            <p>{{$service->description}}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
<!-- testimonial start  -->
<div class="testimonial-section">
    <div class="container">
        <div class="row m-0">
            <div class="col-12 col-md-6">
                <div class="row  m-0 testiminoal-img-main">
                    <div class="col-12 col-sm-6 col-md-12 col-lg-6 testiminoal-img-item">
                        <img src="{{ asset('front/img/testiminoal-img.png') }}" class="img-fluid" alt="" title="">
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
 <!-- why choose us start  -->
<!-- why choose us start  -->
    <div class="why-choose-section">
        <div class="container">
            <div class="row m-0 p-10 why-choose-box-main">
               
                <div class="col-12 col-md-12">
                    <div class="why-choose-main">
                        <div class="why-choose-item  text-center">
                            <h4>Why Choose Us?</h4>
                            <h5> Why Choose Auto Car Repair Service?</h5>
                            <p>Our goal is to ensure that every customer’s satisfaction is guaranteed. We 
                                have a range of highly skilled technicians who can perform work on a 
                                variety of makes and models.</p>    
                        </div>
                        <div class="row m-0 why-choose-section-new">
                            <div class="col-12 col-sm-3"> 
                                <div class="why-choose-inner-item">
                                    <img src="{{ asset('front/img/why-mechanic.webp') }}" class="img-fluid" alt="" title="car repair service">
                                    <h4>Skilled Technicians</h4>
                                    <p>We want to get you in and out quickly while providing you top notch auto repair service.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <div class="why-choose-inner-item">
                                    <img src="{{ asset('front/img/why-qualservice.webp') }}" class="img-fluid" alt="" title="car repair service">
                                    <h4>Quality Services</h4>
                                    <p>We take pride in offering you the best services available and 100% Satisfaction Guarantee.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <div class="why-choose-inner-item">
                                    <img src="{{ asset('front/img/why-car-insurance.webp') }}" class="img-fluid" alt="" title="">
                                    <h4>Insurance Claims</h4>
                                    <p>We take pride in offering you the best services available and 100% Satisfaction Guarantee.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <div class="why-choose-inner-item">
                                    <img src="{{ asset('front/img/why-car-parts.webp') }}" class="img-fluid" alt="" title="">
                                    <h4>100% OEM Genuien Parts</h4>
                                    <p>We want to get you in and out quickly while providing you top notch auto repair service.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- why choose us end  -->
    <!-- why choose us end  -->
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
    });
</script>
@endsection
