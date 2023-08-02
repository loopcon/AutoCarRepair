<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constant;
use App\Models\HomePageSetting;
use App\Models\ServiceCategory;
use DB;

class HomeController extends MainController
{
    public function index()
    {
        $return_data = array();
        $return_data['settings'] = $this->data;
        $hsetting = HomePageSetting::select('section1_title1', 'section1_title2', 'section1_image', 'section1_description', 'meta_title', 'meta_keywords', 'meta_description')->where('id', 1)->first();
        $return_data['hsetting'] = $hsetting;
        $meta_title = isset($hsetting->meta_title) && $hsetting->meta_title ? $hsetting->meta_title : NULL;
        $return_data['meta_keywords'] =  isset($hsetting->meta_keywords) && $hsetting->meta_keywords ? $hsetting->meta_keywords : NULL;
        $return_data['meta_description'] =  isset($hsetting->meta_description) && $hsetting->meta_description ? $hsetting->meta_description : NULL;
        $return_data['site_title'] = $meta_title ? $meta_title : trans('Home');
        $return_data['scategories'] = ServiceCategory::select('id', 'slug', 'title', 'image')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->orderBy('id', 'desc')->get();

        return view('front/index',array_merge($this->data,$return_data));
    }
}