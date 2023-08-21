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
<!-- <di class="row">
    <div class="testiminoal-img-main-text">
        <h4>Sheduled Package</h4>
    </div>
</div> -->
<div class="service-innersection-mian">
    <div class="container">
        @if(isset($detail) && $detail->count())
            @foreach($detail as $record)
                <div class="service-inner-mainbg">
                    <div class="row">
                        <div class="col-12 col-md-4">
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
                                    <!--<a href="#">View All</a>-->
                                </div>
                                @php($specifications = isset($record->specifications) && $record->specifications->count() ? $record->specifications : '')
                                @if($specifications)
                                    @foreach($specifications as $srecord)
                                        <div class="col-12 col-sm-6 basic-service-text-main">
                                            <p><i class="fa-solid fa-circle-check"></i> {{$srecord->specification}} </p>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="payment-main" >
                        <div class="packeage-prise"> <p>₹ {{$record->price}}</p>  </div>
                        <div> <button class="ser-inner-addtocart" id="add_to_cart_service" data-id="{{$record->id}}"> Add to Cart</button></div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    @if(isset($faqs->name) && isset($faqs->description))
        <div class="faq-section-main">
            <div class="container">
                <div class="row justify-content-center">
                    <div class=" col-lg-10">
                        <div id="accordion" class="accordion">
                            <div class="accordion-box faq-text-content">
                                <a href="#" class="accordion-header" data-target="acrd_1">{{isset($faqs->name) && $faqs->name ? $faqs->name :'' }}</a>
                                <div class="accordion-content" id="acrd" style="display:block">
                                    <p class="accordion-text-content">
                                        {!! isset($faqs->description) && $faqs->description ? $faqs->description :'' !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    @endif
</div>

<!-- service inner page end -->
@endsection
@section('javascript')
<script>
$(document).ready(function(){
    $(document).on('click', '#add_to_cart_service', function(){
        var service_id = $(this).data('id');
        swal({
            title: "",
            text: "Are you sure? You want to add this product to cart!",
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
});
</script>
@endsection