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
                        <img src="{{ asset('public/uploads/product/'.$product->id.'/'.$product->primaryImage->image) }}" class="img-fluid" alt="" title="">
                    @else
                        <img src="{{ asset('front/img/no_image.jpg') }}" class="img-fluid" alt="" title="">
                    @endif */ ?>
                    <span class="product-title">{{$product->name}}</span>
                    <span class="product-category-title">Category : {{isset($product->shopCategoryDetail->name) ? $product->shopCategoryDetail->name : ''}}</span>
                    <div class="shoping-card-prise">
                        <div class="shoping-card-text"><p>₹{{$product->price}}</p></div>
                         <?php /*<div class="shoping-star-group">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div> */ ?>
                    </div>
                    <button class="shop-add-btn">Add to cart</button>
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