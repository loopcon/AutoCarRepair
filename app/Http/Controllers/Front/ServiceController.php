<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constant;
use App\Models\ServiceCategory;
use DB;

class ServiceController extends MainController
{
    public function services()
    {
        $return_data = array();
        $return_data['site_title'] = 'Our Services';
        $return_data['scategories'] = ServiceCategory::select('id', 'slug', 'title', 'image', 'description')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->orderBy('id', 'desc')->get();

        return view('front/service/list',array_merge($this->data,$return_data));
    }
}