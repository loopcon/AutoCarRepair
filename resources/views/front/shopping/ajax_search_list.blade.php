@if($products)
    @foreach($products as $product)
        <div class="col-12 col-sm-6 col-md-6 col-lg-4">
            <div class="shoping-main-product">
                @if(isset($product->primaryImage->image) && $product->primaryImage->image)
                    <img src="{{ url($product->primaryImage->image) }}" class="img-fluid" alt="" title="">
                @else
                    <img src="{{ asset('front/img/no_image.jpg') }}" class="img-fluid" alt="" title="">
                @endif
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
        </div>
    @endforeach
    <div class="pagination-main">
        <div class="pagination justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
@endif