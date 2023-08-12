<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constant;
use App\Models\ServiceCategory;
use App\Models\ScheduledPackage;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\Enquiry;
use App\Models\FuelType;
use Session;

class ServiceController extends MainController
{
    public function services()
    {
        $return_data = array();
        $return_data['site_title'] = 'Our Services';
        $brand_id = Session::get('brand_id');
        $model_id = Session::get('model_id');
        $fuel_id = Session::get('fuel_id');

        $carray = array();
        $brandInfo = CarBrand::select('id', 'slug')->where([['id', $brand_id]])->first();
        $modelInfo = CarModel::select('id', 'slug')->where([['id', $model_id]])->first();
        $fuelInfo = FuelType::select('id', 'slug')->where([['id', $fuel_id]])->first();
        if(isset($brandInfo->id) && $brandInfo->id && isset($modelInfo->id) && $modelInfo->id && isset($fuelInfo->id) && $fuelInfo->id){
            $squery = ScheduledPackage::select('sc_id')->where([['brand_id', $brand_id], ['model_id' , $model_id], ['fuel_type_id', $fuel_id]])->groupBy('sc_id')->get();
            if($squery->count()){
                foreach($squery as $record){
                    array_push($carray, $record->sc_id);
                }
            }
            $return_data['brand'] = isset($brandInfo->slug) && $brandInfo->slug ? $brandInfo->slug : NULL;
            $return_data['model'] = isset($modelInfo->slug) && $modelInfo->slug ? $modelInfo->slug : NULL;
            $return_data['fuel'] = isset($fuelInfo->slug) && $fuelInfo->slug ? $fuelInfo->slug : NULL;
            $return_data['scategories'] = ServiceCategory::select('id', 'slug', 'title', 'image', 'description')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->whereIn('id', $carray)->orderBy('id', 'desc')->get();
        } else {
            $return_data['scategories'] = ServiceCategory::select('id', 'slug', 'title', 'image', 'description')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->orderBy('id', 'desc')->get();
        }
        
        $return_data['carray'] = $carray;

        return view('front/service/list',array_merge($this->data,$return_data));
    }

    public function detail(request $request)
    {
        $category = $request->segment(1);
        $brand = $request->brand;
        $model = $request->model;
        $fuel = $request->fuel;

//        dd($fuel);
        $query = ScheduledPackage::with('categoryDetail', 'brandDetail', 'modelDetail', 'fuelTypeDetail', 'specifications')->select('*');
        $query->whereHas('categoryDetail', function($q) use($category) {
            $q->where('slug', $category);
        });
        if($brand){
            $query->whereHas('brandDetail', function($q) use($brand) {
                $q->where('slug', $brand);
            });
        }
        if($model){
            $query->whereHas('modelDetail', function($q) use($model) {
                $q->where('slug', $model);
            });
        }
        if($fuel){
            $query->whereHas('fuelTypeDetail', function($q) use($fuel) {
                $q->where('slug', $fuel);
            });
        }
        $query->orderBy('id', 'desc');
        $services = $query->get();

        $categoryInfo = ServiceCategory::select('*')->where([['slug', $category]])->first();
        $return_data = array();
        $meta_title = isset($categoryInfo->meta_title) && $categoryInfo->meta_title ? $categoryInfo->meta_title : NULL;
        $return_data['meta_keywords'] =  isset($categoryInfo->meta_keywords) && $categoryInfo->meta_keywords ? $categoryInfo->meta_keywords : NULL;
        $return_data['meta_description'] =  isset($categoryInfo->meta_description) && $categoryInfo->meta_description ? $categoryInfo->meta_description : NULL;
        $return_data['site_title'] = $meta_title ? $meta_title : trans('Service Detail');
        $return_data['category'] = $categoryInfo;
        $return_data['detail'] = $services;
        $return_data['price_show'] = '0';
        if($brand && $model && $fuel){
            $return_data['price_show'] = '1';
        }

        return view('front/service/detail',array_merge($this->data,$return_data));
    }
    // public function sendMassage(request $request)
    // {
    //     //print_r("model ajaxEditModelHtml");exit;
    //     if($request->ajax()){
    //         $id = $request->id;
    //         $id = $id ? Crypt::decrypt($id) : NULL;
    //         $record  = Enquiry::select('id','name','email')->where([['is_archive', Constant::NOT_ARCHIVE]])->orderby('id')->get(); 
    //         $html = view('front.service.enquiry', array('record' => $record))->render();
    //         $return = array();
    //         $return['html'] = $html;
    //         echo json_encode($return);
    //     } else {
    //         return redirect('backend/dashboard');
    //     }
    // }
}