<!-- footer start  -->
<div class="footer-bg-main">
    <div class="footer-widthset">  
        <div class="row m-0">
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="footer-img-main">
                    <img src="{{ asset('front/img/acr-logo.png') }}"  alt="">
                    <p>{{$footer_description}}</p>
                </div>
                
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="row m-0">
                    <div class="col-2">
                        <img src="{{ asset('front/img/footer-location.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-10 footer-address">
                        <p>{!! $address !!}</p>
                    </div>
                </div>
                <div class="row m-0 footer-email-main">
                    <div class="col-2">
                        <img src="{{ asset('front/img/footer-email.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-10 footer-email">
                        <p>Email US:</p>
                        <a href="mailto:{{$email}}">{{$email}}</a>
                    </div>
                </div>
                <div class="row m-0 footer-call-main">
                    <div class="col-2">
                        <img src="{{ asset('front/img/footer-call.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-10 footer-call">
                        <p>Call:</p>
                        <a href="tel:{{$phone}}"> {{$phone}} </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-2">
                <ul class="fot-about-main">
                    <li><a class="fot-about-main-header" href="#">About Us </a></li>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Blogs</a></li>
                    <li><a href="#">Contact US</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-10 col-sm-4 col-lg-2">
                <ul class="fot-ourservice-main">
                    <li><a class="fot-ourservice-heading" href="#">Our Services</a></li>
                    @php($services = getServiceCategory())
                    @if($services->count())
                        @foreach($services as $service)
                            <li><a href="#">{{$service->title}}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="col-2 col-sm-2 col-lg-1 footer-msgimg-main">
                <img src="{{ asset('front/img/footer-msg.png') }}" class="img-fluid" alt="">
            </div>  
        </div>
    </div>
</div>
<!-- footer end  -->
<!-- footer down start -->
    <div class="footet-down-bg">
        <div class="footet-down-main">
            <div class="row m-0">
                <div class="col-12 col-sm-6  col-md-4 main-soical-icon">
                    <p>Follow Us:  </p>
                    <div>
                        <a href="https://{{$facebook}}" target="blank"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://{{$twitter}}" target="blank"><i class="fa-brands fa-twitter"></i></a>
                        <a href="https://{{$linkedin}}" target="blank"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="https://{{$instagram}}" target="blank"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://{{$youtube}}" target="blank"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-5 copy-right-text-main">
                    <p>© {{$copyright_year}} - {{$site_name}} - All rights reserved</p>
                </div>
                <div class="col-12 col-sm-6 col-md-3 back-top-main">
                    <p>Back to Top </p>
                    <img src="{{ asset('front/img/back-top.png') }}" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </div>
<!-- footer down end -->
<script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('front/js/all.min.js') }}"></script>
<script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
<script>
    $(document).ready(function() {
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

        $('.btn-toggle-item').click(function(){
            $('.mobile-toggle-data').toggle();
        });
    });
</script>
</body>
</html>