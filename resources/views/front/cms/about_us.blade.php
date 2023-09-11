@extends('front.layout.main')
@section('content')
<!-- about section start  -->
<div class="container">
    <div class="about-main-sec">
        <h1>{{ strtoupper($site_title) }}</h1>
        <p class="about-text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here'</p>
    </div>
    <div class="row align-items-center about-image-text-main">
        <div class="col-12 col-sm-6">
            <div>
                <img src="{{ asset('front/img/about-img.png') }}" class="img-fluid" alt="">
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <h4>PEOPLE</h4>
            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here'
                <br>
               It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here''</p>
        </div>

    </div>
</div>
<!-- about brand logo  slider start  -->
@if($brand_logo_slider->count())
    <div class="aboutus-logo-section">
        <div class="container">
            <div id="aboutus-brand-carousel" class="owl-carousel owl-theme">
                @foreach($brand_logo_slider as $record)
                    @if(isset($record->image) && $record->image)
                        <div class="item">
                            <div class="about-partner-brand-logo">
                                <img src="{{ url($record->image) }}"  alt="">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif
<!-- about brand logo  slider end -->
<!-- about section  end -->
@endsection
@section('javascript')
<script src="{{ asset('front/js/jquery.min.js') }}"></script>
<script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('front/js/all.min.js') }}"></script>
<script src="{{ asset('plugins/notification/toastr.min.js') }}"></script>
<script src="{{asset('plugins/sweetalert/sweetalert.js')}}" type="text/javascript"></script>
<script src="{{ asset('plugins/parsley/parsley.js') }}"></script>
<script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
<script>
$(document).ready(function() {
        $('#aboutus-brand-carousel').owlCarousel({
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