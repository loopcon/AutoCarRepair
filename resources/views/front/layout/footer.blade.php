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
                    @php($cmsInfo = getCmsPageName('1'))
                    @if(isset($cmsInfo->slug) && $cmsInfo->slug)
                        <li><a class="fot-about-main-header" href="{{url($cmsInfo->slug)}}">{{isset($cmsInfo->name) ? ucwords($cmsInfo->name) : ''}}</a></li>
                    @endif
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Blogs</a></li>
                    <li><a href="{{url('contact-us')}}">Contact US</a></li>
                    @php($cmsInfo = getCmsPageName('10'))
                    @if(isset($cmsInfo->slug) && $cmsInfo->slug)
                        <li><a href="{{url($cmsInfo->slug)}}">{{isset($cmsInfo->name) ? ucwords($cmsInfo->name) : ''}}</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-10 col-sm-4 col-lg-2">
                <ul class="fot-ourservice-main">
                    <li><a class="fot-ourservice-heading" href="{{route('front_our-services')}}">Our Services</a></li>
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
<script src="{{ asset('front/js/jquery.min.js') }}"></script>
<script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('front/js/all.min.js') }}"></script>
<script>
    $(document).ready(function() {
        basic();
        // notification //
        <?php if (Session::get('error')) : ?>
            toastr.error('<?php echo Session::get('error') ?>');
        <?php endif; ?>
        <?php if (Session::get('errors')) : ?>
            toastr.error('<?php echo Session::get('errors')->first() ?>');
        <?php endif; ?>
        <?php if (Session::get('success')) : ?>
            toastr.success('<?php echo Session::get('success') ?>');
        <?php endif; ?>
        <?php if (Session::get('warning')) : ?>
            toastr.warning('<?php echo Session::get('warning') ?>');
        <?php endif; ?>

        $('.btn-toggle-item').click(function(){
            $('.mobile-toggle-data').toggle();
        });
    });
    function basic(){
        $("input").attr("autocomplete", "off");
        $("textarea").attr("autocomplete", "off");
        $("input[type=password]").attr("autocomplete", "new-password");
        $(".numeric").bind("keypress", function (e) {
            var keyCode = e.which ? e.which : e.keyCode;
            if (!((keyCode >= 48 && keyCode <= 57) || keyCode == 46)) {
                return false;
            }
        });
        $(".num_only").bind("keypress", function (e) {
            var keyCode = e.which ? e.which : e.keyCode;
            if (!((keyCode >= 48 && keyCode <= 57))) {
                return false;
            }
        });
        $(document).on('keypress', '.alphabetic', function (event) {
            var regex = new RegExp("^[a-zA-Z ]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });
    }
    function PreviewImage(no) 
    {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage"+no).files[0]);
        oFReader.onload = function (oFREvent) 
        {
            document.getElementById("uploadPreview"+no).src = oFREvent.target.result;
            $('#uploadPreview'+no).removeClass('npPreviewImage');
            $('#uploadPreview'+no).addClass('previewImage');
            $('#uploadPreview'+no).css('width', '250px');
        };
    }
</script>
@yield('javascript')
</body>
</html>