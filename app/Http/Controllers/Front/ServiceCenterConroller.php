<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceCenterDetail;
use App\Constant;

class ServiceCenterConroller extends MainController
{
    public function index()
    {
        $return_data = array();
        $return_data['site_title'] = trans('Service Center');
        $service_center = ServiceCenterDetail::orderBy('id','desc')->get();
        $return_data['service_center'] = $service_center;
        return view('front/servicecenter/index',array_merge($this->data,$return_data));
    }
}
