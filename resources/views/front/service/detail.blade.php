@extends('front.layout.main')
@section('content')
<!-- service inner page start  -->
<div class="service-inner-tophead">
    @if(isset($category->image_1) && $category->image_1)
        <img src="{{ asset('public/uploads/service/category/'.$category->image_1) }}" class="ser-inner-banner img-fluid" alt="">
    @else
        <img src="{{ asset('front/img/service-inner-bg.png')}}" class="ser-inner-banner img-fluid" alt="">
    @endif
    <div class="service-inner-tophead-text">
        <h2>{{isset($category->title) && $category->title ? $category->title : ''}}</h2>
        <ul class="ser-inner-breadcum">
            <li><a href="{{route('front_/')}}">Home</a></li>
            <li><i class="fa-solid fa-angles-right"></i></li>
            <li><a href="{{route('front_our-services')}}">Car Service</a></li>
            <li><i class="fa-solid fa-angles-right"></i></li>
            <li>{{isset($category->title) && $category->title ? $category->title : ''}}</li>
        </ul>
    </div>
</div>

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
                    @if($price_show)
                        <div class="payment-main" >
                            <div class="packeage-prise"> <p>₹ {{$record->price}}</p>  </div>
                            <div> <button class="ser-inner-addtocart"> Add to Cart</button></div>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</div>
<!-- service inner page end -->
@endsection