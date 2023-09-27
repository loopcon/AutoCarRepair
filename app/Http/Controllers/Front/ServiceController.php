<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constant;
use App\Models\ServiceCategory;
use App\Models\Faq;
use App\Models\ScheduledPackage;
use App\Models\ScheduledPackageDetail;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\Enquiry;
use App\Models\FuelType;
use App\Models\Cart;
use App\Models\Seo;
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
        
        if($brand_id && $model_id && $fuel_id){} else{
            $brandInfo = CarBrand::select('id')->where([['title', 'MARUTI SUZUKI']])->first();
            $brand_id = isset($brandInfo->id) ? $brandInfo->id  : NULL;

            $modelInfo = CarModel::select('id')->where([['title', 'SWIFT']])->first();
            $model_id = isset($modelInfo->id) ? $modelInfo->id  : NULL;

            $fuelInfo = FuelType::select('id')->where([['title', 'Petrol']])->first();
            $fuel_id =  isset($fuelInfo->id) ? $fuelInfo->id  : NULL;
        }
//        dd($brand_id."----".$model_id."-------".$fuel_id);
        $carray = array();
        $brandInfo = CarBrand::select('id', 'slug')->where([['id', $brand_id]])->first();
        $modelInfo = CarModel::select('id', 'slug')->where([['id', $model_id]])->first();
        $fuelInfo = FuelType::select('id', 'slug')->where([['id', $fuel_id]])->first();
        if(isset($brandInfo->id) && $brandInfo->id && isset($modelInfo->id) && $modelInfo->id && isset($fuelInfo->id) && $fuelInfo->id){
            $squery = ScheduledPackageDetail::with('packageDetail')->select('id', 'sp_id')->where([['brand_id', $brand_id], ['model_id' , $model_id], ['fuel_type_id', $fuel_id]])->get();
            // $squery = ScheduledPackage::select('sc_id')->where([['brand_id', $brand_id], ['model_id' , $model_id], ['fuel_type_id', $fuel_id]])->groupBy('sc_id')->get();
            if($squery && $squery->count()){
                foreach($squery as $record){
                    if(isset($record->packageDetail->sc_id)){
                        array_push($carray, $record->packageDetail->sc_id);
                    }
                }
            }
            $return_data['brand'] = isset($brandInfo->slug) && $brandInfo->slug ? $brandInfo->slug : NULL;
            $return_data['model'] = isset($modelInfo->slug) && $modelInfo->slug ? $modelInfo->slug : NULL;
            $return_data['fuel'] = isset($fuelInfo->slug) && $fuelInfo->slug ? $fuelInfo->slug : NULL;
            // $return_data['scategories'] = ServiceCategory::select('id', 'slug', 'title', 'image','icon_image', 'description')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->whereIn('id', $carray)->orderBy('order_by', 'asc')->get();
            $return_data['scategories'] = ServiceCategory::select('id', 'slug', 'title', 'image', 'icon_image', 'description')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->orderBy('order_by', 'asc')->get();
        } else {
            $return_data['scategories'] = ServiceCategory::select('id', 'slug', 'title', 'image', 'icon_image', 'description')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->orderBy('order_by', 'asc')->get();
        }
        
        $return_data['carray'] = $carray;
        $our_service = Seo::select('meta_title','meta_keyword','meta_description','extra_meta_description')->where('id', Constant::OUR_SERVICE_SEO_ID)->first();
        $return_data['meta_keywords'] =  isset($our_service->meta_keyword) && $our_service->meta_keyword ? $our_service->meta_keyword : NULL;
        $return_data['meta_description'] = isset($our_service->meta_description) && $our_service->meta_description ? $our_service->meta_description : NULL;
        $return_data['extra_meta_description'] =  isset($our_service->extra_meta_description) && $our_service->extra_meta_description ? $our_service->extra_meta_description : NULL;
        return view('front/service/list',array_merge($this->data,$return_data));
    }

    public function detail(request $request)
    {
        $category = $request->segment(1);
        $brand = $request->brand;
        $model = $request->model;
        $fuel = $request->fuel;

        //  dd($brand."----".$model."-------".$fuel);
        $query = ScheduledPackage::with('categoryDetail', 'specifications')->select('*');
        $query->whereHas('categoryDetail', function($q) use($category) {
                $q->where('slug', $category);
        });
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
//        dd($services);
        $return_data['price_show'] = '0';
//        dd($brand.'-------'.$model.'--------'.$fuel);
        if($brand && $model && $fuel){
            $return_data['price_show'] = '1';
        }
        $faqs = Faq::select('id','service_category_id','name','description')->where('service_category_id',$categoryInfo->id)->where('is_archive','0')->get();
        $return_data['faqs'] = $faqs;
        $price_list = ServiceCategory::select('id','price_list')->where
        ('slug',$category)->first();
        $return_data['price_list'] = $price_list;

        $brandquery = CarBrand::select('id', 'slug','title','image')->where([['slug', $brand]])->first();
        $return_data['brandquery'] = $brandquery;

        $modelname = CarModel::select('id', 'slug','title','image')->where([['slug', $model]])->first();
        $return_data['modelname'] = $modelname;

        $fuelname = FuelType::select('id', 'slug','title','image')->where([['slug', $fuel]])->first();
        $return_data['fuelname'] = $fuelname;
        
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