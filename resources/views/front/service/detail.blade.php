@extends('front.layout.main')
@section('content')
<input type="hidden" id="is_service_page" value="1">
<input type="hidden" id="current_service_slug" value="{{isset($category->slug) && $category->slug ? $category->slug : ''}}">
<!-- service inner page start  -->
<div class="shoping-breadcrum-bg">
    <div class="container">
        <div class="row m-0 align-items-center">
            <div class="col-12 col-sm-6">
                <ul class="shoping-breadcrum-main">
                    <li><a href="{{route('front_/')}}">Home</a></li>
                    <li><i class="fa-solid fa-chevron-right"></i></li>
                    <li><a href="{{route('front_our-services')}}">Car Service</a></li>
                    <li><i class="fa-solid fa-chevron-right"></i></li>
                    <li>{{isset($category->title) && $category->title ? $category->title : ''}}</li>
                </ul>
            </div>
            @php($sbrand_id = Session::get('brand_id'))
            @php($smodel_id = Session::get('model_id'))
            @php($sfuel_id = Session::get('fuel_id'))
            @if($sbrand_id && $smodel_id && $sfuel_id)
                <div class="col-12 col-sm-6 p-0">
                    <div class="row m-0">
                        <div class="col-4 d-flex justify-content-end">
                            <div class="car-modal-name">
                                @if(isset($brandquery->image) && $brandquery->image)
                                    <img src="{{ url($brandquery->image )}}" class="brand-name-image" alt="" title="">
                                @endif
                                <p class="service-inner-modalname">{{isset($brandquery->title) ? $brandquery->title : NULL}}</p>
                            </div>
                        </div>
                        <div class="col-4 d-flex justify-content-end">
                            <div class="car-modal-image">
                                @if(isset($modelname->image) && $modelname->image)
                                        <img src="{{ url($modelname->image )}}" class="brand-name-image" alt="" title="">
                                @endif
                                <p class="service-inner-modalname">{{isset($modelname->title) ? $modelname->title : NULL}}</p>
                            </div>
                        </div>
                        <div class="col-4 d-flex justify-content-end">
                            <div class="car-modal-cng">
                                @if(isset($fuelname->image) && $fuelname->image)
                                        <img src="{{ url('public/uploads/fueltype/'.$fuelname->image )}}" class="brand-name-image" alt="" title="">
                                @endif
                                <p class="service-inner-modalname">{{isset($fuelname->title) ? $fuelname->title : NULL}}</p>
                            </div>
                        </div>
                    </div>
                 </div>
            @endif
        </div>
    </div>
</div>
<!--css start -->
<style>
.our-service-section .servic-type-box h5{ color: #222; font-size: 18px; font-weight: bold;  text-align: center; margin-bottom: 0px; }
.our-service-section .servic-type-box {background: #f1f1f1;}
.table-wrapper{border-collapse: collapse;margin: 25px 0;font-size: 0.9em;font-family: sans-serif;min-width: 400px;box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);}
.table-wrapper thead tr {background-color: #222;color: #ffffff;text-align: left;}
.table-wrapper th, .table-wrapper td { padding: 12px 15px; }
.table-wrapper tbody tr {border-bottom: 1px solid #dddddd;}
.table-wrapper tbody tr:nth-of-type(even) {background-color: #f3f3f3;}
.table-wrapper tbody tr:last-of-type {border-bottom: 2px solid #222;}
.table-wrapper tbody tr.active-row {font-weight: bold;color: #009879;}
</style>
<!--css end-->
<div class="service-innersection-mian">
    <div class="container">
        <h1 class="Scheduled-heading-seriner">Scheduled Packages</h1>
        <!-- <h2>Scheduled Packages</h2> -->
        @if(isset($detail) && $detail->count())
            @foreach($detail as $record)
                @php($packageDetail = $record)
                <div class="service-inner-mainbg">
                    <div class="row">
                        <div class="col-12 col-md-4">
                        
                        @if(isset($packageDetail->note) && $packageDetail->note)
                            <div class="d-flex">
                                <h3 class="recommanded-heading">{{ $packageDetail->note }}</h3>
                            </div>
                        @endif 
                            @if(isset($packageDetail->image) && $packageDetail->image)
                                <img src="{{ url('public/uploads/service/package/'.$packageDetail->image )}}" class="img-fluid" alt="" title="">
                            @else
                                <img src="{{ asset('front/img/inner-palish-service.png') }}" class="img-fluid" alt="" title="">
                            @endif
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="row">
                                <div class="service-inner-basic-heading">
                                    <h2>{{$packageDetail->title}}</h2>
                                </div>
                                <div class="col-12 text-end">
                                    @if($packageDetail->time_takes_option=="Hour")
                                        <span><i class="fa fa-clock"></i>&nbsp;{{$packageDetail->time_takes}} Hour(s) Taken</span>
                                    @else
                                        <span><i class="fa fa-clock"></i>&nbsp;{{$packageDetail->time_takes_day}} Day(s) Taken</span>
                                    @endif
                                </div>
                                <div class="col-12 col-sm-6 basic-service-text-main">
                                    <ul>
                                @if(isset($packageDetail->warrenty_info) && $packageDetail->warrenty_info != null)
                                        <li>{{$packageDetail->warrenty_info}}</li>
                                @endif
                                    </ul>
                                </div>
                                <div class="col-12 col-sm-6 basic-service-text-main">
                                    <ul>
                                @if(isset($packageDetail->recommended_info) && $packageDetail->recommended_info != null)
                                        <li>{{$packageDetail->recommended_info}}</li>
                                @endif
                                    </ul>
                                    <!-- <a href="#">View All</a> -->
                                    <!-- <a href="#" class="more"><span>View All</span></a>  -->
                                </div>
                                @php($specifications = isset($packageDetail->specifications) && $packageDetail->specifications->count() ? $packageDetail->specifications : '')
                                @if($specifications)
                                    @foreach($specifications as $skey => $srecord)
                                        <div class="col-12 col-sm-6 basic-service-text-main spacification s{{$record->id}} @if($skey > 4) {{'d-none'}} @endif" >
                                            <div class="service-inner-textname">
                                                <span><i class="fa-solid fa-circle-check"></i></span>  <p> {{$srecord->specification}} </p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                @if($specifications && $specifications->count() > 5)
                                    <div class="col-12 col-sm-6" id="more{{$record->id}}">
                                        <a href="javascript:void(0)" data-id="{{$record->id}}" class="more"><small>+{{ $specifications->count() - 5 }} more View All</small></a> 
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if($price_show)
                        <div class="payment-main">
                            @php($brand_id = isset($brandquery->id) && $brandquery->id ? $brandquery->id : NULL)
                            @php($model_id = isset($modelname->id) && $modelname->id ? $modelname->id : NULL)
                            @php($fuel_id = isset($fuelname->id) && $fuelname->id ? $fuelname->id : NULL)
                            @php($priceInfo = getServicePrice($brand_id, $model_id, $fuel_id, $record->id))
                            @if(isset($priceInfo->price) && $priceInfo->price > 0)
                                <div class="packeage-prise"> <p>₹ {{$priceInfo->price}}</p>  </div>
                                @if($sbrand_id && $smodel_id && $sfuel_id)
                                    <div> <button class="ser-inner-addtocart" id="add_to_cart_service" data-id="{{$priceInfo->id}}"> Add to Cart</button></div>
                                @else
                                    <div> <button class="ser-inner-addtocart apt-btn"> Select Your Car</button></div>
                                @endif
                            @else
                                <div class="packeage-prise"> <p>N/A</p>  </div>
                            @endif
                        </div>
                    @else
                        <?php /* <div class="serin-appointment-btn-maingroup ">
                            <a class="apt-btn serin-appointment-btn" href="javascript:void(0)">Book A Service</a>
                        </div> */ ?>
                        <div class="payment-main">
                            <div class="packeage-prise"> <p>N/A</p>  </div>
                            <?php /* <a class="apt-btn serin-appointment-btn" href="javascript:void(0)">Book A Service</a> */ ?>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
        <div class="row mb-3 text-center"> <a href="{{url('our-services')}}"><button class="explore-more-btnseriner">Explore More Services</button></a></div>
    </div>
    <!-- service inner page end -->
    <!-- testimonial start  -->
    <div class="testimonial-section">
        <div class="container">
            <div class="row m-0">
                <div class="col-12 col-md-6">
                    <div class="row  m-0 testiminoal-img-main">
                        <div class="col-12 col-sm-6 col-md-6 testiminoal-img-item">
                            <img src="{{ asset('front/img/testiminoal-img.png') }}" class="img-fluid" alt="" title="">
                        </div>
                        <div class="col-12 col-sm-6 col-md-6">
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
                                    
                                    <p class="review-without-ellipsis">“Got my Jeep Compass serviced from them about 4 days ago.
                                        My experience,right from the first call with Vishal(incharge of the call center) to the point i got my Jeep back,was very smooth.
                                        My Vehicle was picked up by them on the dot of the shedule time-very punctua! Got a call from Vikas(service supervisor) to understand any spacific needs of mine.
                                        Vishal and Vikas both were in regular tuch to inform the progress.i will give the center 5 stars in all aspects, vehicle is performing well,very courteous and efficient professinals.
                                        Have no hesitation of recommending the service center as a multibrand service center for high end as well as other cars/SUVs.Good people and reasonable costs.Keep it up Vishal and Vikas and all othe team members.”
                                    </p> 
                                </div>
                                 <button class="readmore">Read more</button> 
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
                                    <p class="review-with-ellipsis">“Much appreciation to Vikas Ji Who Worked on my car. Not only did he have extensive Knowledge and expertise, but olso displayed exceptional professionalism throughout the process.
                                        The efficiency with wich he completed the repairs was remarkable. Despite the workshop being rather busy, he managed to promptly diagnose and fix the problem. In conclusion, if you are in need of any vehicle repairs, this is the place to go. They exceeded my expectations, and I have complete confidence that they will do the same for anyone else seeking their services.”
                                    </p>
                                    <p class="review-without-ellipsis">“Much appreciation to Vikas Ji Who Worked on my car. Not only did he have extensive Knowledge and expertise, but olso displayed exceptional professionalism throughout the process.
                                        The efficiency with wich he completed the repairs was remarkable. Despite the workshop being rather busy, he managed to promptly diagnose and fix the problem. In conclusion, if you are in need of any vehicle repairs, this is the place to go. They exceeded my expectations, and I have complete confidence that they will do the same for anyone else seeking their services.”
                                    </p>
                                </div>
                                <button class="readmore">Read more</button> 
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
                                    <p class="review-with-ellipsis">“it was a plesant experience to wath CCR Service doing the service of nmy i10 car. The car was picked from my residence at the appointmented time and the service was done with clockwise precision n returned back to me. i am fully satisfied and am impressed by Mr Vishal for handling the entire process professionally and in an efficient manner. I wish all the success to ACR Service Center.”</p>
                                    <p class="review-without-ellipsis">“it was a plesant experience to wath CCR Service doing the service of nmy i10 car. The car was picked from my residence at the appointmented time and the service was done with clockwise precision n returned back to me. i am fully satisfied and am impressed by Mr Vishal for handling the entire process professionally and in an efficient manner. I wish all the success to ACR Service Center.”</p>
                                </div>
                                <button class="readmore">Read more</button> 
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
                                    <p class="review-with-ellipsis">“Best stopper for car service, had a great experience, got my job done before time, staff is polite.
                                        Would recommend to everyone who are looking for hassle free service.
    
                                        Services: Transmission, A/Cservices, Air & cabin filter replacement, Tire air pump, Tire pressure testing, Vehicle Inspection.”
                                    </p>
                                    <p class="review-without-ellipsis">“Best stopper for car service, had a great experience, got my job done before time, staff is polite.
                                        Would recommend to everyone who are looking for hassle free service.
    
                                        Services: Transmission, A/Cservices, Air & cabin filter replacement, Tire air pump, Tire pressure testing, Vehicle Inspection.”
                                    </p>
                                </div>
                                <button class="readmore">Read more</button> 
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
                                    <p class="review-with-ellipsis">“Had Great experience With ACR. In terms of work, Staff Behaviour, expenses, Everything.
                                        Things were fully organised. To be honest i have saved almost 10 to 12k on my complete work if i compare With Hyundai showroom, They gave me the Estimation of Approx 10k just the simple service, but In ACR i got the same things done in just 3800.
                                        My car is Running So smooth.
                                        Special thanks to Vishal Biswas and Vikas. Keep it up guys."
                                    </p>
                                    <p class="review-without-ellipsis">“Had Great experience With ACR. In terms of work, Staff Behaviour, expenses, Everything.
                                        Things were fully organised. To be honest i have saved almost 10 to 12k on my complete work if i compare With Hyundai showroom, They gave me the Estimation of Approx 10k just the simple service, but In ACR i got the same things done in just 3800.
                                        My car is Running So smooth.
                                        Special thanks to Vishal Biswas and Vikas. Keep it up guys."
                                    </p>
                                </div>
                                <button class="readmore">Read more</button> 
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
    <!-- faq start -->
    @if($faqs->count())
        <div class="faq-section-main mb-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class=" col-lg-10">
                        <div id="accordion" class="accordion">
                            @foreach($faqs as $key => $faq)
                                <div class="accordion-box faq-text-content">
                                    <a href="#" class="accordion-header @if($key == 0) {{'active-accordion'}} @endif" data-target="acrd_1">{{ isset($faq->name) && $faq->name ? $faq->name : '' }}</a>
                                    <div class="accordion-content" id="acrd_{{$key+1}}" style="@if($key == 0) {{'display:block'}} @endif">
                                        <p class="accordion-text-content">
                                            {!! isset($faq->description) && $faq->description ? $faq->description : '' !!}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- faq end -->
    <!-- </div> -->
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
                            <div class="col-12 col-sm-6 col-lg-3 p-0"> 
                                <div class="why-choose-inner-item">
                                    <img src="{{ asset('front/img/skilled technicians.webp') }}" class="img-fluid" alt="" title="car repair service">
                                    <h4>Skilled Technicians</h4>
                                    <p>We want to get you in and out quickly while providing you top notch auto repair service.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3 p-0">
                                <div class="why-choose-inner-item">
                                    <img src="{{ asset('front/img/why-qualservice.webp') }}" class="img-fluid" alt="" title="car repair service">
                                    <h4>Quality Services</h4>
                                    <p>We take pride in offering you the best services available and 100% Satisfaction Guarantee.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3 p-0">
                                <div class="why-choose-inner-item">
                                    <img src="{{ asset('front/img/why-car-insurance.webp') }}" class="img-fluid" alt="" title="">
                                    <h4>Insurance Claims</h4>
                                    <p>We take pride in offering you the best services available and 100% Satisfaction Guarantee.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3 p-0">
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
    @if(isset($price_list->price_list) && $price_list->price_list)
        <div class="container">
            <div class="col-12">
                <h3 class="service-prise-heading">Car Services Price List in NCR, Delhi 2023</h3>
            </div>
            <div class="service-prise-listmain">
                {!! $price_list->price_list !!}
            </div>
        </div>
    @endif
@endsection
@section('javascript')
<script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
<script>
$(document).ready(function(){
    $(document).on('click', '#add_to_cart_service', function(){
        var service_id = $(this).data('id');
        /*swal({
            title: "",
            text: "Thanks For Selecting This Service Package",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "{{__('Cancel')}}",
            closeOnConfirm: true
        },
        function(){
            addItemToCart(service_id);
        });*/
		addItemToCart(service_id);
    });
    function addItemToCart(service_id){
        var qty = '1';
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url : '{{ route('front_add-to-cart') }}',
            method : 'post',
            data : {_token: CSRF_TOKEN, service_id : service_id, qty : qty},
            success : function(result){
                var data = $.parseJSON(result);
                if(data.result == 'error'){
                    toastr.error(data.message);
                } else {
                    toastr.success('','Item successfully added to cart!',{timeOut: 1});
                    setCartItemCount();
                }
            }
        });
    }
    $(function() {
	    $(".accordion-header").click(function(event) {
		    event.preventDefault();
		    var dis = $(this);
		    var acr_box = dis.closest(".accordion");
            if(!dis.hasClass("active-accordion")){
                acr_box.find(".accordion-header").removeClass("active-accordion");
                dis.addClass("active-accordion");
                acr_box.find(".accordion-content").slideUp();
                dis.next().stop(true,true).slideToggle();
            }
	    });
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

    $(document).on("click", '.readmore',function(){
        var owl_item_row = $(this).closest('.owl-item');
        owl_item_row.find('.review-without-ellipsis').show();
        owl_item_row.find('.review-with-ellipsis').hide();
        $(this).addClass('readless').removeClass('readmore');
        $(this).text("Read less");
    });
        
    $(document).on("click", '.readless',function(){
        var owl_item_row = $(this).closest('.owl-item');
        owl_item_row.find('.review-without-ellipsis').hide();
        owl_item_row.find('.review-with-ellipsis').show();
        $(this).addClass('readmore').removeClass('readless');
        $(this).text("Read more");
    });

    $(document).on('click', '.more', function(){
        var id = $(this).data('id');
        $('.s'+id).removeClass('d-none');
        $('#more'+id).remove();
    });
});
</script>
@endsection