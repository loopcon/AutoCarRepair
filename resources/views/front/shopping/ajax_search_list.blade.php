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