
<!-- new footer start  -->
<div class="footer-soical-icon">
    <a href="https://{{$facebook}}" target="blank"><i class="fa-brands fa-facebook-f"></i></a>
    <a href="https://{{$instagram}}" target="blank"><i class="fa-brands fa-instagram"></i></a>
    <a href="https://{{$twitter}}" target="blank"><img src="{{ asset('front/img/twitter.png') }}"  alt=""></a>
    <a href="https://{{$linkedin}}" target="blank"><i class="fa-brands fa-linkedin"></i></a>
    <a href="https://{{$youtube}}" target="blank"><i class="fa-brands fa-youtube"></i></a>
    <a href="https://wa.me/{{$whatsapp}}" target="blank"><i class="fa-brands fa-whatsapp"></i></a>
</div>
<div class="newfooter-bg-main">
    <div class="row m-0">
        <div class="col-12 col-sm-6 col-md-3">
            <ul class="our-service-main">
                <li class="our-section-head">OUR SERVICES</li>
                @php($services = getServiceCategory())
                @if($services->count())
                    @foreach($services as $service)
                        @php($brand_id = Session::get('brand_id'))
                        @php($model_id = Session::get('model_id'))
                        @php($fuel_id = Session::get('fuel_id'))
                        @if($brand_id && $model_id && $fuel_id)
                            @php($brand = getBrandSlugFromBrandId($brand_id))
                            @php($model = getModelSlugFromModelId($model_id))
                            @php($fuel = getFuelSlugFromFuelId($fuel_id))
                            <li><a href="{{url($service->slug.'/'.$brand.'/'.$model.'/'.$fuel)}}">{{$service->title}}</a></li>
                        @else
                            <li><a href="{{url($service->slug)}}">{{$service->title}}</a></li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <ul class="our-service-main">
                <li class="our-section-head">LUXURY BRANDS</li>
                @php($compnyInfo = getCompnyCmsPages())
                @if(isset($compnyInfo['second_section']))
                    @foreach($compnyInfo['second_section'] as $info)
                        @if(isset($info->slug) && $info->slug)
                            <li><a href="{{url($info->slug)}}">{{isset($info->name) ? ucwords($info->name) : ''}}</a></li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <ul class="our-service-main">
                <li class="our-section-head">POPULAR BRANDS</li>
                @if(isset($compnyInfo['third_section']))
                    @foreach($compnyInfo['third_section'] as $info)
                        @if(isset($info->slug) && $info->slug)
                            <li><a href="{{url($info->slug)}}">{{isset($info->name) ? ucwords($info->name) : ''}}</a></li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <ul class="our-service-main">
                <li class="our-section-head">POPULAR AREAS NEAR YOU</li>
                @if(isset($compnyInfo['forth_section']))
                    @foreach($compnyInfo['forth_section'] as $info)
                        @if(isset($info->slug) && $info->slug)
                            <li><a href="{{url($info->slug)}}">{{isset($info->name) ? ucwords($info->name) : ''}}</a></li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>
<div class="footer-address">
    <div class="row m-0 align-items-center">
        <div class="col-12 col-sm-6 col-md-2">
            <div>
                <img src="{{ asset('front/img/acr-my-tvs.webp') }}" class="acr-my-tvsimage"  alt="">
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="contact-number-main">
                <p>
                    <img src="{{ asset('front/img/call-image.webp') }}" class="call-image-main" alt="">
                   <a href="tel:{{$phone}}" class="footer-number-main">{{$phone}}</a>
                </p>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6">
            <div class="address-text-main">
                <div class="address-main-imagesec">
                    <img src="{{ asset('front/img/location-icon-footer.png') }}" class="addres-image-main" alt="">
                </div>
                <a href="javascript:void(0);">{!! $address !!}</a>
            </div>
        </div>
    </div>
</div>
<div class="footer-menu-main">
    <div>
        <ul class="footer-menu-item">
            <li><a href="{{url('about-us')}}">About Us</a></li>
            <li><a href="{{url('faqs')}}">FAQs</a></li>
            <li><a href="{{url('contact-us')}}">Contact Us</a></li>
            <li><a href="https://autocarrepair.in/blogs/" target="_blank">Blogs</a></li>
            @php($cmsInfo = getCmsPageName('10'))
                @if(isset($cmsInfo->slug) && $cmsInfo->slug)
                    <li><a href="{{url($cmsInfo->slug)}}">{{isset($cmsInfo->name) ? ucwords($cmsInfo->name) : ''}}</a></li>
                @endif
            @php($cmsInfo = getCmsPageName('12'))
            @if(isset($cmsInfo->slug) && $cmsInfo->slug)
                <li><a href="{{url($cmsInfo->slug)}}">{{isset($cmsInfo->name) ? ucwords($cmsInfo->name) : ''}}</a></li>
            @endif
        </ul>
    </div>
    <div>
        <p class="copy-right-text">© {{$copyright_year}} - {{$site_name}} All Right Reserved</p>
    </div>
</div>
<!-- new footer end  -->

<!-- footer start  -->
<?php /*<div class="footer-bg-main">
    <div class="footer-widthset">  
        <div class="row m-0">
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="footer-img-main">
                    <img src="{{ asset('front/img/acr-logo.webp') }}"  alt="">
                    <p>{{$footer_description}}</p>
                </div>
                
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="row m-0">
                    <div class="col-2">
                        <img src="{{ asset('front/img/footer-location.webp') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-10 footer-address">
                        <p>{!! $address !!}</p>
                    </div>
                </div>
                <div class="row m-0 footer-email-main">
                    <div class="col-2">
                        <img src="{{ asset('front/img/footer-email.webp') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-10 footer-email">
                        <p>Email US:</p>
                        <a href="mailto:{{$email}}">{{$email}}</a>
                    </div>
                </div>
                <div class="row m-0 footer-call-main">
                    <div class="col-2">
                        <img src="{{ asset('front/img/footer-call.webp') }}" class="img-fluid" alt="">
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
                    <li><a href="{{url('faqs')}}">FAQs</a></li>
                    <li><a href="#">Blogs</a></li>
                    <li><a href="{{url('contact-us')}}">Contact US</a></li>
                    @php($cmsInfo = getCmsPageName('10'))
                    @if(isset($cmsInfo->slug) && $cmsInfo->slug)
                        <li><a href="{{url($cmsInfo->slug)}}">{{isset($cmsInfo->name) ? ucwords($cmsInfo->name) : ''}}</a></li>
                    @endif
                    @php($cmsInfo = getCmsPageName('12'))
                    @if(isset($cmsInfo->slug) && $cmsInfo->slug)
                        <li><a href="{{url($cmsInfo->slug)}}">{{isset($cmsInfo->name) ? ucwords($cmsInfo->name) : ''}}</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-10 col-sm-4 col-lg-3">
                <ul class="fot-ourservice-main">
                    <li><a class="fot-ourservice-heading" href="{{route('front_our-services')}}">Our Services</a></li>
                    @php($services = getServiceCategory())
                    @if($services->count())
                        @foreach($services as $service)
                            <li><a href="{{url($service->slug)}}">{{$service->title}}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
           <?php /* <div class="col-2 col-sm-2 col-lg-1 footer-msgimg-main">
                <img src="{{ asset('front/img/footer-msg.webp') }}" class="img-fluid" alt="">
            </div> * / ?> 
        </div>
    </div>
</div> */ ?>
<!-- footer end  -->
<div class="footer-whatappicon">
     <a href="https://wa.me/{{$whatsapp}}" target="_blank"><img src="{{ asset('front/img/whatsapp-acr-img.webp') }}" class="img-fluid" alt=""></a>
     <a href="#" id="up-button-main" class=""> 
        <img src="{{ asset('front/img/back-top.png') }}" class="home-back-totoptext" alt="">
    </a>
</div>
<!-- footer down start -->
    <?php /*  <div class="footet-down-bg">
        <div class="footet-down-main">
            <div class="row m-0">
                <div class="col-12 col-sm-6  col-md-4 main-soical-icon">
                    <?php / * <p>Follow Us:  </p>
                    <div>
                        <a href="https://{{$facebook}}" target="blank"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://{{$twitter}}" target="blank"><i class="fa-brands fa-twitter"></i></a>
                        <a href="https://{{$linkedin}}" target="blank"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="https://{{$instagram}}" target="blank"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://{{$youtube}}" target="blank"><i class="fa-brands fa-youtube"></i></a>
                    </div> * /?>
                </div> 
                <div class="col-12 col-sm-6 col-md-5 copy-right-text-main">
                    <p>© {{$copyright_year}} - {{$site_name}} - All rights reserved</p>
                </div>
                <div class="col-12 col-sm-6 col-md-3 back-top-main">
                    <a href="#" class="home-back-totoptext"> Back to Top 
                        <img src="{{ asset('front/img/back-top.png') }}" class="img-fluid" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div> */ ?>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- footer down end -->
<script src="{{ asset('front/js/jquery.min.js') }}"></script>
<script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('front/js/all.min.js') }}"></script>
<script src="{{ asset('plugins/notification/toastr.min.js') }}"></script>
<script src="{{asset('plugins/sweetalert/sweetalert.js')}}" type="text/javascript"></script>
<script src="{{ asset('plugins/parsley/parsley.js') }}"></script>
<script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
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

        $(window).scroll(function () { 
            if ($(window).scrollTop() > 50) {
                $('#header-sticky').addClass('sticky');
                $('#up-button-main').addClass('up-btn-sticky');
                $('#up-button-main').css('display','block');
            }
            if ($(window).scrollTop() < 51) {
                $('#header-sticky').removeClass('sticky');
                $('#up-button-main').removeClass('up-btn-sticky');
                $('#up-button-main').css('display','none');
            }
        });

        $(document).on('keyup', '#search_brand', function(){
            var search_brand = $(this).val();
            searchBrand(search_brand);
        });

        $(document).on('click', '.amodal-brand', function(){
            var brand_id = $(this).data('id');
            modelFromBrandSearch(brand_id, '');
        });

        $(document).on('keyup', '#search_model', function(){
            var search_model = $(this).val();
            var brand_id = "{{session()->get('brand_id')}}";
            modelFromBrandSearch(brand_id, search_model);
        });

        $(document).on('click', '.amodal-model', function(){
            var model_id = $(this).data('id');
            fuelFromModelSearch(model_id, '');
        });

        $(document).on('keyup', '#search_fuel', function(){
            var search_fuel = $(this).val();
            fuelFromModelSearch('', search_fuel);
        });

        $(document).on('click', '.amodal-fuel', function(){
            var fuel_id = $(this).data('id');
            appointmentnumberModal(fuel_id);
        });

        $(document).on('click', '.apt-btn', function(){
            appointmentnumberModal(fuel_id = '');
        });
        $('#appointmentselectModal').on('hidden.bs.modal', function() {
            $('#search_brand').val('');
        });
        $('#appointmentsearchModal').on('hidden.bs.modal', function() {
            $('#search_model').val('');
        });
        $('#appointmentfuelModal').on('hidden.bs.modal', function() {
            $('#search_fuel').val('');
        });

        $(document).on('click', '#check_price', function(){
            var phone = $('#appointmentmobile').val();
            var length = phone.length;
            if(phone == ''){
                toastr.error('Please enter phone number!');
            } else if(length != '10'){
                toastr.error('Please enter valid phone number!');
            } else {
                location.href = "{{url('our-services')}}";
                <?php /*var csrfToken = $('meta[name="csrf-token"]').attr('content');
                 $.ajax({
                    url: "{{ route('front_storePhoneInSession') }}", // Change to your route name
                    type: "POST",
                    data: {phone: phone, _token: csrfToken},
                    dataType: "json",
                    success: function(data) {
                        // Redirect to the desired URL
                        location.href = "{{url('our-services')}}";
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX Error: ' + textStatus, errorThrown);
                    }
                });*/ ?>
            }
        });

        //otp in popop
        $('#appointmentresend_otp').hide();
        $('.aptotp-section').hide();
        /*var phone = "{{ Cache::get('phone') }}";
        if(phone)
        {
            $('#check_price').show();
            $('#appointmentsend_otp').hide();
        }
        else
        {
            $('#check_price').hide();
            $('#appointmentsend_otp').show();
        }*/
        $(document).on('click', '#appointmentsend_otp', function(){
            var validateMobNum= /[1-9]{1}[0-9]{9}/;
            var mobile = $('#appointmentmobile').val();
            if (validateMobNum.test(mobile) && mobile.length == 10) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url : '{{ route('front_send-otp') }}',
                    method : 'post',
                    data : {_token: CSRF_TOKEN, mobile:mobile},
                    success : function(result){
                        var result = $.parseJSON(result);
                        if(result.result == 'success'){
                            $("#appointmentmobile").attr("readonly", "readonly");
                            $('.aptotp-section').show();
                            $('#appointmentsend_otp').hide();
                            apttimer(30);
                        } else {
                            toastr.error('Something went wrong. Please try again later!');
                        }
                    }
                });
            }
            else {
                toastr.error('Please Enter Valid Mobile No.');
            }
        });

        $(document).on('keyup', '#appointmentotp', function(){
            var mobile = $('#appointmentmobile').val();
            var otp = $('#appointmentotp').val();
            var olength = otp.toString().length;
            if(parseInt(olength) > 3){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url : '{{ route('front_verify-otp') }}',
                    method : 'post',
                    data : {_token: CSRF_TOKEN, mobile:mobile, otp:otp},
                    success : function(result){
                        var result = $.parseJSON(result);
                        if(result.result == 'success'){
                            localStorage.setItem("phone", mobile);
                            $('#appointmentresend_text').hide();
                            $('#appointmentis_otp_verify').val('1');
                            $('#check_price').show();
                            $("#appointmentmobile").attr("readonly", "readonly"); 
                            $('#appointmentotp').hide();
                        } else {
                            toastr.error('Please Enter Valid OTP.');
                        }
                    }
                });
            }
        });

        $(document).on('click', '#appointmentresend_otp', function(){
            var validateMobNum= /[1-9]{1}[0-9]{9}/;
            var mobile = $('#appointmentmobile').val();
            if (validateMobNum.test(mobile) && mobile.length == 10) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url : '{{ route('front_resend-otp') }}',
                    method : 'post',
                    data : {_token: CSRF_TOKEN, mobile:mobile},
                    success : function(result){
                        var result = $.parseJSON(result);
                        if(result.result == 'success'){
                            $('.aptotp-section').show();
                            $('#appointmentresend_text').show();
                            $('#appointmentotp').val('');
                            $('#appointmentotp').show();
                            $("#appointmentmobile").attr("readonly", "readonly");
                            $('#appointmentresend_otp').hide();
                            apttimer(30);
                        } else {
                            toastr.error('Something went wrong. Please try again later!');
                        }
                    }
                });
            }
            else {
                toastr.error('Please Enter Valid Mobile No.');
            }
        });

        $(document).on('keypress', '.search_text',function(e) {
            var $this = $(this);
            if (e.keyCode === 13) {
                var search = $this.val();
                if(search){
                    var href = "{{route('front_search')}}"+'?search='+search;
                    console.log(href);
                    window.location.href = href;
                }
            }
        });
    //
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
        setCartItemCount();
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

    function setCartItemCount(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url : '{{ route('front_cart-item-count') }}',
            method : 'post',
            data : {_token: CSRF_TOKEN},
            success : function(result){
                var result = $.parseJSON(result);
                if(result.total){
                    $('#cart_header_total_item').html('('+result.total+')');
                }
            }
        });
    }

    function searchBrand(search_brand = ''){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url : '{{ route('front_search-brand') }}',
            method : 'post',
            data : {_token: CSRF_TOKEN, brand: search_brand},
            success : function(result){
                var result = $.parseJSON(result);
                $('#amodal_brands').html(result.html);
            }
        });
    }

    function modelFromBrandSearch(brand_id = '', search_model = ''){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url : '{{ route('front_model-from-brand-modal') }}',
            method : 'post',
            data : {_token: CSRF_TOKEN, brand_id: brand_id, model:search_model},
            success : function(result){
                var result = $.parseJSON(result);
                $('#amodal_models').html(result.html);
                $('#appointmentsearchModal').modal('show');
                $('#appointmentselectModal').modal('hide');
            }
        });
    }

    function fuelFromModelSearch(model_id = '', search_fuel = ''){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url : '{{ route('front_search-fuel-from-model') }}',
            method : 'post',
            data : {_token: CSRF_TOKEN, model_id: model_id, fuel: search_fuel},
            success : function(result){
                var result = $.parseJSON(result);
                $('#amodal_fuels').html(result.html);
                $('#appointmentfuelModal').modal('show');
                $('#appointmentsearchModal').modal('hide');
            }
        });
    }

    function appointmentnumberModal(fuel_id){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url : '{{ route('front_appoitment-number-modal') }}',
            method : 'post',
            data : {_token: CSRF_TOKEN, fuel_id: fuel_id},
            success : function(result){
                var result = $.parseJSON(result);
                $('#appointmentfuelModal').modal('hide');
                if(result.result == 'success' && result.type == 'number'){
                    $('#search_info').html(result.html);
                    $('#appointmentnumberModal').modal('show');
                } else if(result.result == 'success' && result.type == 'fuel'){
                    fuelFromModelSearch();
                } else if(result.result == 'success' && result.type == 'model'){
                    modelFromBrandSearch();
                } else {
                    $('#appointmentselectModal').modal('show');
                }
                var localstorage_phone = localStorage.getItem("phone");
                $("#appointmentmobile").val(localstorage_phone);
                //$("#appointmentmobile").parent().css({"visibility":"hidden"});
                $('#appointmentresend_text').hide();
                $('#appointmentis_otp_verify').val('1');
                $('#check_price').show();
                //$("#appointmentmobile").attr("readonly", "readonly"); 
                $('#appointmentotp').hide();
                $('#appointmentsend_otp').hide();
                console.log(localstorage_phone);
                /*if(localstorage_phone != null) {
                    $("#appointmentmobile").val(localstorage_phone);
                    $("#appointmentmobile").parent().css({"visibility":"hidden"});
                    $('#appointmentresend_text').hide();
                    $('#appointmentis_otp_verify').val('1');
                    $('#check_price').show();
                    $("#appointmentmobile").attr("readonly", "readonly"); 
                    $('#appointmentotp').hide();
                    $('#appointmentsend_otp').hide();
                } else {
                    $('#appointmentsend_otp').show();
                    $('#check_price').hide();
                }*/
            }
        });

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

    }
    let timerStart = true;
    function apttimer(remaining) {
        var m = Math.floor(remaining / 60);
        var s = remaining % 60;
        m = m < 10 ? '0' + m : m;
        s = s < 10 ? '0' + s : s;
        document.getElementById('apttimer').innerHTML = m + ':' + s;
        remaining -= 1;
        if(remaining >= 0 && timerStart) {
        setTimeout(function() {
            apttimer(remaining);
        }, 1000);
        return;
        }

        if(!timerStart) {
        // Do validate stuff here
        return;
        }
        // Do timeout stuff here
        var is_otp_verify = $('#appointmentis_otp_verify').val();
        if(is_otp_verify == '0'){
            $('#appointmentresend_otp').show();
            $("#appointmentmobile").removeAttr("readonly"); 
            $('#appointmentresend_text').hide();
            $('#appointmentotp').hide();
        }
    }
</script>
@yield('javascript')
</body>
</html>