@extends('front.layout.main')
@section('content')
<!-- service inner page start  -->
<div class="shoping-breadcrum-bg">
    <div class="container">
        <ul class="shoping-breadcrum-main">
            <li><a href="{{route('front_/')}}">Home</a></li>
            <li><i class="fa-solid fa-chevron-right"></i></li>
            <li><a href="{{route('front_our-services')}}">Car Service</a></li>
            <li><i class="fa-solid fa-chevron-right"></i></li>
            <li>{{isset($category->title) && $category->title ? $category->title : ''}}</li>
        </ul>
    </div>
</div>

<div class="service-innersection-mian">
    <div class="container">
        <h2 class="Scheduled-heading-seriner">Scheduled Packages</h2>
        <!-- <h2>Scheduled Packages</h2> -->
        @if(isset($detail) && $detail->count())
            @foreach($detail as $record)
                @if($price_show)
                    @php($packageDetail = $record->packageDetail)
                @else
                    @php($packageDetail = $record)
                @endif
                <div class="service-inner-mainbg">
                    <div class="row">
                        <div class="col-12 col-md-4">
                        
                        @if(isset($packageDetail->note) && $packageDetail->note)
                            <div class="d-flex">
                                <h3 class="recommanded-heading">{{ $packageDetail->note }}</h3>
                            </div>
                        @endif 
                            @if(isset($packageDetail->image) && $packageDetail->image)
                                <img src="{{ url($packageDetail->image )}}" class="img-fluid" alt="" title="">
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
                                    <span><i class="fa fa-clock"></i>&nbsp;{{$packageDetail->time_takes}} hrs Taken</span>
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
                                            <p><i class="fa-solid fa-circle-check"></i> {{$srecord->specification}} </p>
                                        </div>
                                    @endforeach
                                @endif
                                @if($specifications->count() > 5)
                                    <div class="col-12 col-sm-3" id="more{{$record->id}}">
                                        <a href="javascript:void(0)" data-id="{{$record->id}}" class="more"><small>+{{ $specifications->count() - 5 }} more View All</small></a> 
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if($price_show)
                        <div class="payment-main">
                            <div class="packeage-prise"> <p>₹ {{$record->price}}</p>  </div>
                            <div> <button class="ser-inner-addtocart" id="add_to_cart_service" data-id="{{$record->id}}"> Add to Cart</button></div>
                        </div>
                    @else
                        <?php /* <div class="serin-appointment-btn-maingroup ">
                            <a class="apt-btn serin-appointment-btn" href="javascript:void(0)">Book A Service</a>
                        </div> */ ?>
                        <div class="payment-main">
                            <div class="packeage-prise"> <p>N/A</p>  </div>
                            <a class="apt-btn serin-appointment-btn" href="javascript:void(0)">Book A Service</a>
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
                            <div>
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
            <div class="row m-0 why-choose-box-main">
                <div class="col-12 col-md-6">
                    <div class="why-choose-img-main">
                        <img src="{{ asset('front/img/advance-service-main.webp') }}" class="img-fluid" alt="" title="">
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
                                    <img src="{{ asset('front/img/why-mechanic.webp') }}" class="img-fluid" alt="" title="">
                                    <h4>Skilled Technicians</h4>
                                    <p>We want to get you in and out quickly while providing you top notch auto repair service in Delhi.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="why-choose-inner-item">
                                    <img src="{{ asset('front/img/why-qualservice.webp') }}" class="img-fluid" alt="" title="">
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
    @if(isset($price_list->price_list) && $price_list->price_list)
        <div class="container">
            <div class="col-12">
                <h3>Car Services Price List in NCR, Delhi 2023</h3>
            </div>
            {!! $price_list->price_list !!}
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
                toastr.success('Item successfully added to cart!');
                setCartItemCount();
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

    $(document).on('click', '.more', function(){
        var id = $(this).data('id');
        $('.s'+id).removeClass('d-none');
        $('#more'+id).remove();
    });
});
</script>
@endsection