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
                        <a href="{{url($href)}}">
                            <div class="servic-type-box">
                                <img src="{{asset('front/img/our-service-img.png')}}" class="img-fluid" alt="">
                                <h4>{{ $service->title }}</h4>
                                <p>{{$service->description}}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
