@extends('front.layout.main')
@section('content')
<!-- product-inner page start  -->
<div class="shoping-breadcrum-bg">
    <div class="container">
        <ul class="shoping-breadcrum-main">
            <li><a href="{{url('shopping')}}">Shopping </a></li>
            <li><i class="fa-solid fa-chevron-right"></i></li>
            <li>{{$record->name}}</li>
        </ul>
    </div>
</div>

<div class="shopping-innerbg-secmain"> 
    <div class="container">
    <div class="shopping-innerbg">
        <div class="row">
            <div class="col-12 col-md-6">
                <div id="sync1" class="owl-carousel owl-theme">
                    @if(isset($record->images) && $record->images->count())
                        @foreach($record->images as $image)
                            <div class="item">
                                <div class="product-inner-imgmain">
                                    <img src="{{ asset('public/uploads/product/'.$record->id.'/'.$image->image) }}" class="img-fluid" alt="" title="{{isset($image->image_title) ? $image->image_title : NULL}}">
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div id="sync2" class="owl-carousel owl-theme">
                    @if(isset($record->images) && $record->images->count())
                        @foreach($record->images as $image)
                            <div class="item">
                                <div class="product-inner-imgmain">
                                    <img src="{{ asset('public/uploads/product/'.$record->id.'/'.$image->image) }}" class="img-fluid" alt="" title="{{isset($image->image_title) ? $image->image_title : NULL}}">
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="product-content-main">
                    <h2>{{$record->name}}</h2>
                    <div class="share-image">
                        <p>Share</p>
                    <?php /*   <a href="https://web.whatsapp.com/send?text={{url('shopping/'.$record->slug)}}" data-action="share/whatsapp/share" target="blank">
                            <img src="{{ asset('front/img/shop-whatsapp.png') }}"  alt="">
                        </a> */ ?>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{url('shopping/'.$record->slug)}}"  target="blank">
                            <img src="{{ asset('front/img/shop-facebook.png') }}" alt="">
                        </a>
                    <?php /*    <a href="https://twitter.com/intent/tweet?url={{url('shopping/'.$record->slug)}}" target="blank">
                            <img src="{{ asset('front/img/shop-twitter.png') }}" alt="">
                        </a> */ ?>
                    </div>
                    <?php /* <a class="write-text" href="#">Write A Review </a> */ ?>
                    <div class="shop-inner-prise">
                        <div class="shopinner-prise-text"><p>₹{{formatNumber($record->price)}}</p></div>
                        <div class="quantity-sec-main">
                            <p>Quantity</p>
                            <input type="hidden" name="product_id" id="product_id" value="{{$record->id}}">
                            <input type="hidden" name="qty" value="1">
                            <div class="frame">
                                <div class="plus-minus-main">
                                      <div class="button plus-col minus-btn-col-1">
                                          <button id="minus-btn"><i class="fa-solid fa-minus"></i></button>
                                      </div>
                                      <div class="number plus-col text-btn-col-2">
                                          <h1 id="count">1</h1>
                                      </div>
                                      <div class="button plus-col plus-btn-col-1">
                                          <button id="plus-btn"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                  </div>
                              </div>
                        </div>
                    </div>
                    <?php /* <div>
                        <button class="addtocard-shopinner" id="add_to_cart">Add To Cart</button>
                        @if($record->amazon_link)
                            <button class="buyfrom-shopinner" onclick="window.open('https://{{$record->amazon_link}}', '_blank')">Buy From Amazon</button>
                        @endif
                        @if($record->flipcart_link)
                            <button class="buyfrom-shopinner" onclick="window.open('https://{{$record->flipcart_link}}', '_blank')">Buy From Flipcart</button>
                        @endif
                    </div> */ ?>
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-6">
                            <button class="addtocard-shopinner" id="add_to_cart">Add To Cart</button>
                        </div>
                    </div>
                    <div class="row justify-content-center"> 
                        @if($record->amazon_link)
                            <div class="col-12 col-sm-6">
                                <button class="buyfrom-shopinner" onclick="window.open('https://{{$record->amazon_link}}', '_blank')">Buy From Amazon</button>
                            </div>
                        @endif
                        @if($record->flipcart_link)
                            <div class="col-12 col-sm-6">
                                <button class="buyfrom-shopinner" onclick="window.open('https://{{$record->flipcart_link}}', '_blank')">Buy From Flipcart</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="description-main">
            <ul id="tabs">
                <li class="description-btn active"> Description</li>
                <li class="specification-btn">Specification</li>
            </ul>
            <ul id="tab">
                <li class="active">
                    <p>{!! $record->description !!}</p>
                </li>
                <li>
                    <ul class="specification-tab-text">
                        {!! $record->specification !!}
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>
<!-- product-inner page end -->
@endsection
@section('javascript')
<script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
<script>    
    $(document).ready(function(){
        $('.fliter-main ul li a svg').click(function(){
            $('.fliter-item1').toggle();
        })

        var sync1 = $("#sync1");
        var sync2 = $("#sync2");
        var slidesPerPage = 3; //globaly define number of elements per page
        var syncedSecondary = true;

        sync1.owlCarousel({
            items: 1,
            slideSpeed: 2000,
            nav: true,
            autoplay: true, 
            dots: false,
            loop: true,
            responsiveRefreshRate: 200,
            navText: ['<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>', '<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],
        }).on('changed.owl.carousel', syncPosition);

        sync2
            .on('initialized.owl.carousel', function() {
                sync2.find(".owl-item").eq(0).addClass("current");
            })
            .owlCarousel({
                items: slidesPerPage,
                dots: false,
                nav: true,
                smartSpeed: 200,
                slideSpeed: 500,
                slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
                responsiveRefreshRate: 100
            }).on('changed.owl.carousel', syncPosition2);

            function syncPosition(el) {
                //if you set loop to false, you have to restore this next line
                //var current = el.item.index;

                //if you disable loop you have to comment this block
                var count = el.item.count - 1;
                var current = Math.round(el.item.index - (el.item.count / 2) - .5);

                if (current < 0) {
                    current = count;
                }
                if (current > count) {
                    current = 0;
                }

                //end block

                sync2
                    .find(".owl-item")
                    .removeClass("current")
                    .eq(current)
                    .addClass("current");
                var onscreen = sync2.find('.owl-item.active').length - 1;
                var start = sync2.find('.owl-item.active').first().index();
                var end = sync2.find('.owl-item.active').last().index();

                if (current > end) {
                    sync2.data('owl.carousel').to(current, 100, true);
                }
                if (current < start) {
                    sync2.data('owl.carousel').to(current - onscreen, 100, true);
                }
            }

            function syncPosition2(el) {
                if (syncedSecondary) {
                    var number = el.item.index;
                    sync1.data('owl.carousel').to(number, 100, true);
                }
            }

            sync2.on("click", ".owl-item", function(e) {
                e.preventDefault();
                var number = $(this).index();
                sync1.data('owl.carousel').to(number, 300, true);
            });

            $("ul#tabs li").click(function(e){
                if (!$(this).hasClass("active")) {
                    var tabNum = $(this).index();
                    var nthChild = tabNum+1;
                    $("ul#tabs li.active").removeClass("active");
                    $(this).addClass("active");
                    $("ul#tab li.active").removeClass("active");
                    $("ul#tab li:nth-child("+nthChild+")").addClass("active");
                }
            });

        let minusBtn = document.getElementById("minus-btn");
        let count = document.getElementById("count");
        let plusBtn = document.getElementById("plus-btn");

        let countNum = 1;
        count.innerHTML = countNum;
        $('input[name="qty"]').val(countNum);

        minusBtn.addEventListener("click", () => {
//            console.log(countNum);
            if(parseInt(countNum) > 1){
                countNum -= 1;
                count.innerHTML = countNum;
                $('input[name="qty"]').val(countNum);
            }
        });

        plusBtn.addEventListener("click", () => {
            countNum += 1;
            count.innerHTML = countNum;
            $('input[name="qty"]').val(countNum);
        });

        $(document).on('click', '#add_to_cart', function(){
            /*swal({
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
                addItemToCart();
            });*/
            addItemToCart();
        });

        function addItemToCart(){
            var product_id = $('#product_id').val();
            var qty = $('input[name="qty"]').val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url : '{{ route('front_add-to-cart') }}',
                method : 'post',
                data : {_token: CSRF_TOKEN, product_id : product_id, qty : qty},
                success : function(result){
                    toastr.success('Item successfully added to cart!');
                    setCartItemCount();
                }
            });
        }
    });
</script>
@endsection