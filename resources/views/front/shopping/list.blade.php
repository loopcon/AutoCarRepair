@extends('front.layout.main')
@section('content')
<!-- shoping page start  -->
<div class="shoping-breadcrum-bg shoping-category-bg">
    <div class="container">
        <ul class="shoping-breadcrum-main">
            <li><a href="{{url('shopping')}}">Shopping </a></li>
            <li><i class="fa-solid fa-chevron-right"></i></li>
            <li>Category</li>
        </ul>
    </div>
</div>
<div class="shopping-section">
    <div class="container">
        <div class="row">
            <div class="col-12  col-md-4 col-lg-3">
                <div class="fliter-main">
                    <h4 class="shop-category-heading">Shop by Categories</h4>
                    <ul>
                        @if($scategories->count())
                            @foreach($scategories as $category)
                                <li>
                                    <?php /*<a for="pcategory{{$category->id}}" href="javascript:void(0);">
                                        {{$category->name}}
                                        <input class="form-check-input filter_category check-box-fliter" type="checkbox" value="{{$category->id}}" id="pcategory{{$category->id}}">
                                    </a> */ ?>
                                    <label class="filter-click-main" for="pcategory{{$category->id}}">
                                        {{$category->name}}
                                         <input class="form-check-input filter_category check-box-fliter" type="checkbox" value="{{$category->id}}" id="pcategory{{$category->id}}"> 
                                        <span><i class="fa-solid fa-plus"></i></span>
                                    </label>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

               <?php /**<div>
                    <span class="mobile-filter-iconmain"><i class="fa-solid fa-filter"></i></span>
                    <div class="mobile-filter-mian">
                        <h4 class="shop-category-heading">Shop by Categories</h4>
                        <ul>
                            @if($scategories->count())
                                @foreach($scategories as $category)
                                    <li>**/ ?>
                                        <?php /*<a for="pcategory{{$category->id}}" href="javascript:void(0);">
                                            {{$category->name}}
                                            <input class="form-check-input filter_category check-box-fliter" type="checkbox" value="{{$category->id}}" id="pcategory{{$category->id}}">
                                        </a> */ ?>
                                        <?php /**<label class="filter-click-main" for="pcategory{{$category->id}}">
                                            {{$category->name}}
                                             <input class="form-check-input filter_category check-box-fliter" type="checkbox" value="{{$category->id}}" id="pcategory{{$category->id}}"> 
                                            <span><i class="fa-solid fa-plus"></i></span>
                                        </label>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>**/ ?>
            </div> 
            <div class=" col-12  col-md-8 col-lg-9">
                <div class="row" id="search_ajax_list">
                    @if($products)
                        @foreach($products as $product)
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <a href="{{url('shopping/'.$product->slug)}}">
                                    <div class="shoping-main-product">
                                        @if(!empty($product->primaryImage->image) && isset($product->primaryImage->image))
                                            <img src="{{ $product->primaryImage->image }}"  alt="" title="{{ isset($product->primaryImage->image_title) ? $product->primaryImage->image_title : '' }}">
                                        @else
                                            <img src="{{ asset('front/img/no_image.jpg') }}" class="img-fluid" alt="" title="no_image">
                                        @endif
                                        <?php /* @if(isset($product->primaryImage->image) && $product->primaryImage->image)
                                            <img src="{{ asset('public/uploads/product/'.$product->id.'/'.$product->primaryImage->image) }}"  alt="" title="{{isset($product->primaryImage->image_title) ? $product->primaryImage->image_title : ''}}">
                                        @else
                                            <img src="{{ asset('front/img/no_image.jpg') }}" class="img-fluid" alt="" title="no_image">
                                        @endif */ ?>
                                        <div class="shoping-text-name">
                                            <span class="product-title">{{$product->name}}</span>
                                            <span class="product-category-title">category : {{isset($product->shopCategoryDetail->name) ? $product->shopCategoryDetail->name : ''}}</span>
                                        </div>
                                        <div class="shoping-card-prise">
                                            <div class="shoping-card-text"><p>₹{{formatNumber($product->price)}}</p></div>
                                          <?php /*  <div class="shoping-star-group">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            </div> */ ?>
                                        </div>
                                        <button class="shop-add-btn add_to_cart" type="button" data-product_id="{{$product->id}}">Add to cart</button>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        <div class="pagination-main">
                            <div class="pagination justify-content-center">
                                {{ $products->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
<!--            <div class="pagination-main">
                <div class="pagination">
                    <a href="#">&laquo;</a>
                    <a href="#">1</a>
                    <a href="#" class="active">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a href="#">6</a>
                    <a href="#">&raquo;</a>
                </div>
            </div>-->
        </div>
    </div>
</div>
<!-- shoping inner page end -->
@endsection
@section('javascript')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.pagination a',function(event){
                event.preventDefault();
                $('li').removeClass('active');
                $(this).parent('li').addClass('active');
                var myurl = $(this).attr('href');
                var page=$(this).attr('href').split('page=')[1];
                getSearchVals(page);
            });

            $(document).on('click', '.filter_category', function(){
                getSearchVals();
                $(this).siblings('span').find('svg').toggleClass("fa-plus fa-minus");
            });

            $(document).on('click', '.add_to_cart', function(e){
                e.preventDefault();
                var product_id = $(this).data('product_id');
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
                    addItemToCart(product_id);
                });*/
                addItemToCart(product_id);
            });
        });

        $("#checkbox_lbl").click(function(){ 
            if($("#checkbox_id").is(':checked'))
                $("#checkbox_id").removAttr('checked');
            else
            $("#checkbox_id").attr('checked');
            });


        function getSearchVals(page = ''){
            var category = [];
            $('.filter_category:checked').each(function(i, e) {
                category.push($(this).val());
            });

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            if(page){
                var url = '{{ route("front_search-shopping-ajax") }}?page=' + page;
            } else {
                var url = '{{ route("front_search-shopping-ajax") }}';
            }
            $.ajax({
                type: "POST",
                url: url,
                data: {_token: CSRF_TOKEN, category: category},  
                success: function(result){
                    var result = $.parseJSON(result);
                    console.log(result);
                    $('#search_ajax_list').html(result.html);
                }
            });
        }

        function addItemToCart(product_id){
            var qty = 1;
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url : '{{ route('front_add-to-cart') }}',
                method : 'post',
                data : {_token: CSRF_TOKEN, product_id : product_id, qty : qty},
                success : function(result){
                    toastr.success('', 'Item successfully added to cart!', { timeOut: 1000 });
                    setCartItemCount();
                }
            });
        }

        $('.mobile-filter-iconmain').click(function(){
            $('.mobile-filter-mian').toggle();
        });


    </script>
@endsection
