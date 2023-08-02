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
        $return_data['site_title'] = trans('Home');
        $return_data['hsetting'] = HomePageSetting::select('section1_title1', 'section1_title2', 'section1_image', 'section1_description')->where('id', 1)->first();
        $return_data['scategories'] = ServiceCategory::select('id', 'slug', 'title', 'image')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->orderBy('id', 'desc')->get();

        return view('front/index',array_merge($this->data,$return_data));
    }
}