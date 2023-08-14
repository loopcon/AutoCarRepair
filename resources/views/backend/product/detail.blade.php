@extends('backend.layout.main')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('public/plugins/sweetalert/sweetalert.css')}}">
    <link class="js-stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('content')

<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                @include('backend.alerts')
            </div>
        </div>
        <h1 class="h3 mb-3">{{$site_title}}</h1>
        <div class="row col-12">
            <div class="card">
                <div class="row">
                    <div class="col-md-4">
                        <strong>Shop Category</strong>
                        <br>
                        <p class="text-muted">{{isset($detail->shop_category_id) && $detail->shop_category_id ? $detail->shop_category_id : ''}}</p>
                    </div>
                    <div class="col-md-4">
                        <strong>Product Name</strong>
                        <br>
                        <p class="text-muted">{{isset($detail->name) && $detail->name ? $detail->name : ''}}</p>
                    </div>
                    <div class="col-md-4 col-6 b-r">
                        <strong>Sku</strong>
                        <br>
                        <p class="text-muted">{{isset($detail->sku) && $detail->sku ? $detail->sku : ''}}</p>
                    </div>
                    <div class="col-md-4 col-6 b-r">
                        <strong>Description</strong>
                        <br>
                        <p class="text-muted">{{isset($detail->description) && $detail->description ? $detail->description : ''}}</p>
                    </div>
                    <div class="col-md-4 col-6 b-r">
                        <strong>Specification</strong>
                        <br>
                        <p class="text-muted">{{isset($detail->specification) && $detail->specification ? $detail->specification : ''}}</p>
                    </div>
                    <div class="col-md-4 col-6 b-r">
                        <strong>Amazone Link</strong>
                        <br>
                        <p class="text-muted">{{isset($detail->amazon_link) && $detail->amazon_link ? $detail->amazon_link : ''}}</p>
                    </div>
                    <div class="col-md-4 col-6 b-r">
                        <strong>Flipcart Link</strong>
                        <br>
                        <p class="text-muted">{{isset($detail->flipcart_link) && $detail->flipcart_link ? $detail->flipcart_link : ''}}</p>
                    </div>
                    <div class="col-md-4 col-6 b-r">
                        <strong>Price</strong>
                        <br>
                        <p class="text-muted">{{isset($detail->price) && $detail->price ? $detail->price : ''}}</p>
                    </div>
                    <div class="col-md-4 col-6 b-r">
                        <strong>Slug</strong>
                        <br>
                        <p class="text-muted">{{isset($detail->slug) && $detail->slug ? $detail->slug : ''}}</p>
                    </div>
                    <div class="col-md-12">
                        <h4>Seo Details</h4>
                        <hr>
                    </div>
                    <div class="col-md-4 col-6 b-r">
                        <strong>Meta Title</strong>
                        <br>
                        <p class="text-muted">{{isset($detail->meta_title) && $detail->meta_title ? $detail->meta_title : ''}}</p>
                    </div>
                    <div class="col-md-4 col-6 b-r">
                        <strong>Meta Keyword</strong>
                        <br>
                        <p class="text-muted">{{isset($detail->meta_keyword) && $detail->meta_keyword ? $detail->meta_keyword : ''}}</p>
                    </div>
                    <div class="col-md-4 col-6 b-r">
                        <strong>Meta Description</strong>
                        <br>
                        <p class="text-muted">{{isset($detail->meta_description) && $detail->meta_description ? $detail->meta_description : ''}}</p>
                    </div>
                    <div class="col-md-12">
                        <h4>Image</h4>
                        <hr>
                    </div>
                    <div class="col-md-4 col-6 b-r">
                        <strong>Image</strong>
                        <br>
                        @if(isset($detail->primaryImage->image) && $detail->primaryImage->image)
                            <img src="{{url('public/uploads/product/'.$detail->id.'/'.$detail->primaryImage->image)}}">
                        @endif
                    </div>
                    <div class="col-md-4 col-6 b-r">
                        <strong>Primary</strong>
                        <br>
                        <p class="text-muted">{{isset($detail->primaryImage->is_primary) && $detail->primaryImage->is_primary ? $detail->primaryImage->is_primary : ''}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
