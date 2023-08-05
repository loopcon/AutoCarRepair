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
                        <div class="servic-type-box">
                            <img src="{{asset('front/img/our-service-img.png')}}" class="img-fluid" alt="">
                            <h4>{{ $service->title }}</h4>
                            <p>{{$service->description}}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="our-section-main-btngroup">
            <button class="our-ser-send-msgbtn">Send Message</button>
        </div>
    </div>
</div>
<!-- service page end  -->
@endsection