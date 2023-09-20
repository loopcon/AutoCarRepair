<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceCenterDetail;
use App\Models\Seo;
use App\Constant;

class ServiceCenterConroller extends MainController
{
    public function index()
    {
        $return_data = array();
        $return_data['site_title'] = trans('Service Center');
        $service_center = ServiceCenterDetail::orderBy('id','desc')->get();
        $return_data['service_center'] = $service_center;
        $service_center = Seo::select('meta_title','meta_keyword','meta_description','extra_meta_description')->where('id', Constant::SERVICE_CENTER_SEO_ID)->first();
        $return_data['meta_keywords'] =  isset($service_center->meta_keyword) && $service_center->meta_keyword ? $service_center->meta_keyword : NULL;
        $return_data['meta_description'] = isset($service_center->meta_description) && $service_center->meta_description ? $service_center->meta_description : NULL;
        $return_data['extra_meta_description'] =  isset($service_center->extra_meta_description) && $service_center->extra_meta_description ? $service_center->extra_meta_description : NULL;
        return view('front/servicecenter/index',array_merge($this->data,$return_data));
    }

    public function locations()
    {
        $return_data = array();
        $return_data['site_title'] = trans('Service Center');
        $service_center = ServiceCenterDetail::orderBy('id','desc')->get();
        $return_data['auto-car-repair-gurgaon'] = $service_center;
        $our_service = Seo::select('meta_title','meta_keyword','meta_description','extra_meta_description')->where('id', Constant::SERVICE_CENTER_SEO_ID)->first();
        $return_data['meta_keywords'] =  isset($our_service->meta_keyword) && $our_service->meta_keyword ? $our_service->meta_keyword : NULL;
        $return_data['meta_description'] = isset($our_service->meta_description) && $our_service->meta_description ? $our_service->meta_description : NULL;
        $return_data['extra_meta_description'] =  isset($our_service->extra_meta_description) && $our_service->extra_meta_description ? $our_service->extra_meta_description : NULL;
        return view('front/servicecenter/auto-car-repair-gurgaon',array_merge($this->data,$return_data));
    }
}
