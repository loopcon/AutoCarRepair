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
                                <?php /**@if(!empty($service->icon_image) && isset($service->icon_image))
                                    <img src="{{url('uploads/service/category/icon/'.$service->icon_image)}}" class="servic-type-box-image" alt="" title="">
                                @endif**/ ?>  
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
                       <div>
                            <div class="star-group-icon">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="test-slider-text">
                                <p class="review-with-ellipsis">“Got my Jeep Compass serviced from them about 4 days ago.
                                    My experience,right from the first call with Vishal(incharge of the call center) to the point i got my Jeep back,was very smooth.
                                    My Vehicle was picked up by them on the dot of the shedule time-very punctua! Got a call from Vikas(service supervisor) to understand any spacific needs of mine.
                                    Vishal and Vikas both were in regular tuch to inform the progress.i will give the center 5 stars in all aspects, vehicle is performing well,very courteous and efficient professinals.
                                    Have no hesitation of recommending the service center as a multibrand service center for high end as well as other cars/SUVs.Good people and reasonable costs.Keep it up Vishal and Vikas and all othe team members.”
                                </p>
                                
                               <?php /* <p class="review-without-ellipsis">“Got my Jeep Compass serviced from them about 4 days ago.
                                    My experience,right from the first call with Vishal(incharge of the call center) to the point i got my Jeep back,was very smooth.
                                    My Vehicle was picked up by them on the dot of the shedule time-very punctua! Got a call from Vikas(service supervisor) to understand any spacific needs of mine.
                                    Vishal and Vikas both were in regular tuch to inform the progress.i will give the center 5 stars in all aspects, vehicle is performing well,very courteous and efficient professinals.
                                    Have no hesitation of recommending the service center as a multibrand service center for high end as well as other cars/SUVs.Good people and reasonable costs.Keep it up Vishal and Vikas and all othe team members.”
                                </p> */ ?>
                            </div>
                            <?php /* <button class="review-with-readmore" href="">Read more</button> */ ?>
                            <div class="test-rating-sec-main">   
                                <div>
                                    <div class="test-rating-main">
                                        <img src="{{ asset('front/img/r2.png') }}" class="img-fluid" alt="" title="">
                                    </div>
                                </div>  
                                <div class="test-rating-sec-item">
                                    <span>Rajinder Takhar</span>
                                </div>
                            </div>
                       </div>
                    </div>
                    <div class="item">
                        <div>
                            <div class="star-group-icon">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="test-slider-text">
                                <p>“I got my car serviced here. They picked up and dropped my car at my home.
                                    it was hard to trust first but it was good decision I made.
                                    I,m fully satisfied with service and quite impressed with Vishal as he tracks end to end progress and make it done on time.”
                                </p>
                            </div>
                            <div class="test-rating-sec-main">   
                                <div>
                                    <div class="test-rating-main">
                                        <img src="{{ asset('front/img/m.png') }}" class="img-fluid" alt="" title="">
                                    </div>
                                </div>  
                                <div class="test-rating-sec-item">
                                    <span>Mohit Parashar</span>
                                </div>
                            </div>
                       </div>
                    </div>
                    <div class="item">
                        <div>
                            <div class="star-group-icon">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="test-slider-text">
                                <p>“Much appreciation to Vikas Ji Who Worked on my car. Not only did he have extensive Knowledge and expertise, but olso displayed exceptional professionalism throughout the process.
                                    The efficiency with wich he completed the repairs was remarkable. Despite the workshop being rather busy, he managed to promptly diagnose and fix the problem. In conclusion, if you are in need of any vehicle repairs, this is the place to go. They exceeded my expectations, and I have complete confidence that they will do the same for anyone else seeking their services.”
                                </p>
                            </div>
                            <div class="test-rating-sec-main">   
                                <div>
                                    <div class="test-rating-main">
                                        <img src="{{ asset('front/img/s.png') }}" class="img-fluid" alt="" title="">
                                    </div>
                                </div>  
                                <div class="test-rating-sec-item">
                                    <span>Southern Atsara</span>
                                </div>
                            </div>
                       </div>
                    </div>
                    <div class="item">
                        <div>
                            <div class="star-group-icon">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="test-slider-text">
                                <p>“it was a plesant experience to wath CCR Service doing the service of nmy i10 car. The car was picked from my residence at the appointmented time and the service was done with clockwise precision n returned back to me. i am fully satisfied and am impressed by Mr Vishal for handling the entire process professionally and in an efficient manner. I wish all the success to ACR Service Center.”</p>
                            </div>
                            <div class="test-rating-sec-main">   
                                <div>
                                    <div class="test-rating-main">
                                        <img src="{{ asset('front/img/m2.png') }}" class="img-fluid" alt="" title="">
                                    </div>
                                </div>  
                                <div class="test-rating-sec-item">
                                    <span>mahesh joshi</span>
                                </div>
                            </div>
                       </div>
                    </div>
                    <div class="item">
                        <div>
                            <div class="star-group-icon">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="test-slider-text">
                                <p>“Best stopper for car service, had a great experience, got my job done before time, staff is polite.
                                    Would recommend to everyone who are looking for hassle free service.

                                    Services: Transmission, A/Cservices, Air & cabin filter replacement, Tire air pump, Tire pressure testing, Vehicle Inspection.”
                                </p>
                            </div>
                            <div class="test-rating-sec-main">   
                                <div>
                                    <div class="test-rating-main">
                                        <img src="{{ asset('front/img/s2.png') }}" class="img-fluid" alt="" title="">
                                    </div>
                                </div>  
                                <div class="test-rating-sec-item">
                                    <span>Sagar Saini</span>
                                </div>
                            </div>
                       </div>
                    </div>
                    <div class="item">
                        <div>
                            <div class="star-group-icon">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="test-slider-text">
                                <p>“Had Great experience With ACR. In terms of work, Staff Behaviour, expenses, Everything.
                                    Things were fully organised. To be honest i have saved almost 10 to 12k on my complete work if i compare With Hyundai showroom, They gave me the Estimation of Approx 10k just the simple service, but In ACR i got the same things done in just 3800.
                                    My car is Running So smooth.
                                    Special thanks to Vishal Biswas and Vikas. Keep it up guys."
                                </p>
                            </div>
                            <div class="test-rating-sec-main">   
                                <div>
                                    <div class="test-rating-main">
                                        <img src="{{ asset('front/img/r.png') }}" class="img-fluid" alt="" title="">
                                    </div>
                                </div>  
                                <div class="test-rating-sec-item">
                                    <span>Rohit Tanwar</span>
                                </div>
                            </div>
                       </div>
                    </div>
                    <div class="item">
                        <div>
                            <div class="star-group-icon">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="test-slider-text">
                                <p>“I had service my car from ACR. Experience is very nice Mr.Vishal is folloeing with me from Last 2 months very nice person And advice is Mr.Sandeep thanks for your service."</p>
                            </div>
                            <div class="test-rating-sec-main">   
                                <div>
                                    <div class="test-rating-main">
                                        <img src="{{ asset('front/img/u.png') }}" class="img-fluid" alt="" title="">
                                    </div>
                                </div>  
                                <div class="test-rating-sec-item">
                                    <span>udaibhan yadav</span>
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
