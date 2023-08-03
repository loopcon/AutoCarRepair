@extends('front.layout.main')
@section('content')
<!-- shoping page start  -->
<div class="shoping-breadcrum-bg">
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
                    <ul>
                        @if($scategories->count())
                            @foreach($scategories as $category)
                                <li>
                                    <a href="javascript:void(0);">
                                        {{$category->name}}
                                        <input class="form-check-input filter_category" type="checkbox" value="{{$category->id}}" id="pcategory{{$category->id}}">
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class=" col-12  col-md-8 col-lg-9">
                <div class="row" id="search_ajax_list">
                    @if($products)
                        @foreach($products as $product)
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="shoping-main-product">
                                    @if(isset($product->primaryImage->image) && $product->primaryImage->image)
                                        <img src="{{ asset('public/uploads/product/'.$product->id.'/'.$product->primaryImage->image) }}" class="img-fluid" alt="">
                                    @else
                                        <img src="{{ asset('front/img/no_image.jpg') }}" class="img-fluid" alt="">
                                    @endif
                                    <h5>{{$product->name}}</h5>
                                    <h5>{{isset($product->shopCategoryDetail->name) ? $product->shopCategoryDetail->name : ''}}</h5>
                                    <div class="shoping-card-prise">
                                        <div class="shoping-card-text"><p>₹{{$product->price}}</p></div>
                                        <div class="shoping-star-group">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>
                                    <button class="shop-add-btn">Add to cart</button>
                                </div>
                            </div>
                        @endforeach
                        <div class="pagination justify-content-center">
                            {!! $products->links() !!}
                        </div>
                    @endif
                </div>
            </div>
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
            });
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
    </script>
@endsection
