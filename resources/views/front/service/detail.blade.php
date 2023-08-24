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
                <div class="service-inner-mainbg">
                    <div class="row">
                        <div class="col-12 col-md-4">
                        @if(isset($record->note) && $record->note)
                            <div class="d-flex">
                                <h3 class="recommanded-heading">{{ $record->note }}</h3>
                            </div>
                        @endif 
                            @if(isset($record->image) && $record->image)
                                <img src="{{ asset('public/uploads/service/package/'.$record->image) }}" class="img-fluid" alt="">
                            @else
                                <img src="{{ asset('front/img/inner-palish-service.png') }}" class="img-fluid" alt="">
                            @endif
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="row">
                                <div class="service-inner-basic-heading">
                                    <h2>{{$record->title}}</h2>
                                </div>
                                <div class="col-12 text-end">
                                    <span><i class="fa fa-clock"></i>&nbsp;{{$record->time_takes}} hrs Taken</span>
                                </div>
                                <div class="col-12 col-sm-6 basic-service-text-main">
                                    <ul>
                                        <li>{{$record->warrenty_info}}</li>
                                    </ul>
                                </div>
                                <div class="col-12 col-sm-6 basic-service-text-main">
                                    <ul>
                                        <li>{{$record->recommended_info}}</li>
                                    </ul>
                                    <!-- <a href="#">View All</a> -->
                                    <!-- <a href="#" class="more"><span>View All</span></a>  -->
                                </div>
                                @php($specifications = isset($record->specifications) && $record->specifications->count() ? $record->specifications : '')
                                @if($specifications)
                                    @foreach($specifications as $srecord)
                                        <div class="col-12 col-sm-6 basic-service-text-main spacification" >
                                            <p><i class="fa-solid fa-circle-check"></i> {{$srecord->specification}} </p>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="col-12 col-sm-6">
                                    <a href="#" class="more"><small>+{{ $record->specifications->count()-5 }} more View All</small></a> 
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($price_show)
                        <div class="payment-main">
                            <div class="packeage-prise"> <p>₹ {{$record->price}}</p>  </div>
                            <div> <button class="ser-inner-addtocart" id="add_to_cart_service" data-id="{{$record->id}}"> Add to Cart</button></div>
                        </div>
                    @else
                        <div class="serin-appointment-btn-maingroup ">
                            <a class="apt-btn serin-appointment-btn" href="javascript:void(0)">Appointment Now</a>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
    <div class="row mb-3 text-center"> <a href="{{url('our-services')}}"><button class="explore-more-btnseriner">Explore More Services</button></a></div>
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
    </div>
</div>
<!-- service inner page end -->
@endsection
@section('javascript')
<script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
<script>
$(document).ready(function(){
    $(document).on('click', '#add_to_cart_service', function(){
        var service_id = $(this).data('id');
        swal({
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
        });
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

    $(document).ready(function () {
        $('.spacification').hide();
        $('.spacification:lt(5)').show();
        var spacificationcount = $('.spacification').length;
        if (spacificationcount <= 5) 
        { 
        $('.more').hide();
        }
        else 
        {
        $('.more').click(function () {
        $('.spacification:not(:visible):lt(5)').show();
        if($('.spacification:not(:visible)').length<=0)
        {
        $('.more').hide();
        }
        return false;
        });
        } 
    });
});
</script>
@endsection