<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constant;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\ScheduledPackage;
use App\Models\FuelType;
use Session;

class SearchController extends MainController
{
    public function brands(request $request)
    {
        if($request->ajax()){
            $brand = $request->brand ? strtolower(str_replace(' ', '', $request->brand)) : NULL;
            $query = CarBrand::select('id', 'image')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]]);
            if($brand){
                $query->whereRaw("LOWER(REPLACE(title, ' ', '')) LIKE '%".$brand."%'");
            }
            $brands = $query->orderBy('title', 'asc')->get();
            $html = '';
            if($brands->count()){
                foreach($brands as $brand){
                    $html .= '<div class="col-4 brand-logo-center">
                                <a href="javascript:void(0);" class="amodal-brand" data-id="'.$brand->id.'"><img src="'. asset("public/uploads/carbrand/".$brand->image).'" class="img-fluid" alt=""></a>
                            </div>';
                }
            } else {
                $html = '<div class="col-12 p-5"></div>';
            }

            echo json_encode(array('html' => $html));
            exit;
        } else {
            return redirect('/');
        }
    }

    public function modelFromBrandModal(request $request){
        if($request->ajax()){
            $model = $request->model ? strtolower(str_replace(' ', '', $request->model)) : NULL;
            $brand_id = $request->brand_id;
            if(empty($brand_id)){
                $brand_id = Session::get('brand_id');
            } else {
                Session::put('brand_id', $brand_id);
                Session::save();
            }
            $query = CarModel::select('id', 'image', 'title')->where([['carbrand_id', $brand_id], ['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]]);
            if($model){
                $query->whereRaw("LOWER(REPLACE(title, ' ', '')) LIKE '%".$model."%'");
            }
            $models = $query->orderBy('title', 'asc')->get();
            $html = '';
            if($models->count()){
                foreach($models as $model){
                    $html .= '<div class="col-4 brand-logo-center">
                                <a href="javascript:void(0);" class="amodal-model" data-id="'.$model->id.'"><img src="'. asset("public/uploads/carmodel/".$model->image).'" class="img-fluid" alt="">
                                    <p class="select-modal-name">'.$model->title.'</p>
                                </a>
                            </div>';
                }
            } else {
                $html = '<div class="col-12 p-5"></div>';
            }

            echo json_encode(array('html' => $html));
            exit;
        } else {
            return redirect('/');
        }
    }

    public function fuelFromModel(request $request){
        if($request->ajax()){
            $brand_id = Session::get('brand_id');
            $model_id = $request->model_id;
            if(empty($model_id)){
                $model_id = Session::get('model_id');
            } else {
                Session::put('model_id', $model_id);
                Session::save();
            }

            $fuels = ScheduledPackage::select('fuel_type_id')->where([['brand_id', $brand_id], ['model_id', $model_id], ['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->groupBy('fuel_type_id')->get();
            $farray = array();
            if($fuels->count()){
                foreach($fuels as $fuel){
                    array_push($farray, $fuel->fuel_type_id);
                }
            }

            $query = FuelType::select('id', 'title', 'image')->whereIn('id', $farray)->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]]);
            $fuel_data = $query->orderBy('title', 'asc')->get();
            $html = '';
            if($fuel_data->count()){
                foreach($fuel_data as $fuel){
                    $html .= '<div class="col-4 brand-logo-center">
                                <a href="javascript:void(0);" class="amodal-fuel" data-id="'.$fuel->id.'"><img src="'. asset("public/uploads/fueltype/".$fuel->image).'" class="img-fluid" alt="">
                                    <p class="select-modal-name">'.$fuel->title.'</p>
                                </a>
                            </div>';
                }
            } else {
                $html = '<div class="col-12 p-5"></div>';
            }

            echo json_encode(array('html' => $html));
            exit;
        } else {
            return redirect('/');
        }
    }
}