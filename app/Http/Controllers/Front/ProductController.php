<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constant;
use App\Models\ShopCategory;
use App\Models\Product;
use App\Models\Seo;
use DB;

class ProductController extends MainController
{
    public function shopping()
    {
        $return_data = array();
        $return_data['site_title'] = trans('Shopping');
        $return_data['scategories'] = ShopCategory::with('products')->select('id', 'slug', 'name')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->orderBy('id', 'desc')->get();
        $return_data['products'] = Product::with('shopCategoryDetail', 'primaryImage')->select('id', 'slug', 'name', 'sku', 'shop_category_id', 'price')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->orderBy('id', 'desc')->paginate(12);
        $shopping = Seo::select('meta_title','meta_keyword','meta_description','extra_meta_description','canonical_tag')->where('id', Constant::SHOPPING_SEO_ID)->first();
        $return_data['meta_keywords'] =  isset($shopping->meta_keyword) && $shopping->meta_keyword ? $shopping->meta_keyword : NULL;
        $return_data['meta_description'] = isset($shopping->meta_description) && $shopping->meta_description ? $shopping->meta_description : NULL;
        $return_data['extra_meta_description'] =  isset($shopping->extra_meta_description) && $shopping->extra_meta_description ? $shopping->extra_meta_description : NULL;
        $return_data['canonical_tag'] =  isset($shopping->canonical_tag) && $shopping->canonical_tag ? $shopping->canonical_tag : NULL;
        // print_r($return_data['products']);exit;
        return view('front/shopping/list',array_merge($this->data,$return_data));
    }

    public function searchAjax(request $request)
    {
        if($request->ajax()){
            $return_data = array();
            $category = $request->category;
            $query = Product::with('shopCategoryDetail', 'primaryImage')->select('id', 'slug', 'name', 'sku', 'shop_category_id', 'price')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]]);
            if($category){
                $query->whereIn('shop_category_id', $category);
            }
            $return_data['products'] = $query->orderBy('id', 'desc')->paginate(12);
            $html = view('front.shopping.ajax_search_list', $return_data)->render();
            $return = array();
            $return['html'] = $html;
            echo json_encode($return);
        } else {
            return redirect('/');
        }
    }

    public function detail($slug)
    {
        // $segment = request()->segment(2);
        // if($segment){
            $record = Product::with('shopCategoryDetail', 'primaryImage', 'images')->select('*')->where([['is_archive', Constant::NOT_ARCHIVE], ['slug', $slug], ['status', Constant::ACTIVE]])->first();
            if(isset($record->id)){
                $return_data = array();
                $return_data['site_title'] = $record->name;
                $return_data['meta_keywords'] = $record->meta_keywords;
                $return_data['meta_description'] = $record->meta_description;
                $return_data['canonical_tag'] = $record->canonical_tag;
                $return_data['record'] = $record;

                return view('front/shopping/detail',array_merge($this->data,$return_data));
            } else {
                return redirect('/');
            }
        // } else {
        //     return redirect('/');
        // }
    }
}