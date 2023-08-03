<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceCenterDetail;
use Auth;

class ServiceCenterDetailController extends MainController
{
    public function index()
    {
        $return_data = array();
        $return_data['site_title'] = trans('Service Center Detail');
        $return_data['record'] =  ServiceCenterDetail::find(1);
        return view('backend.service_center_detail.index',array_merge($this->data,$return_data));
    }

    public function update(request $request)
    {
        $service_center_detail = ServiceCenterDetail::find(1);
        $fields = array('name','address','phone_number');
        foreach($fields as $field){
            $service_center_detail->$field = isset($request->$field) && $request->$field != '' ? $request->$field : NULL;
        }
        if($request->hasFile('image')) {
            $old_image = isset($service_center_detail->image) ? $service_center_detail->image : NULL;
            if($old_image){
                removeFile('uploads/servicecenterdetail/'.$old_image);
            }
            $newName = fileUpload($request, 'image', 'uploads/servicecenterdetail');
            $service_center_detail->image = $newName;
        }
        $service_center_detail->updated_by = Auth::guard('admin')->user()->id;
        $service_center_detail->save();
        if($service_center_detail){
            return redirect()->back()->with('success ',trans('Service Center Detail Updated Uccessfully'));
        }else{
            return redirect()->back()->with('error ',trans('Something went wrong, please try again later!'));
        }
    }
}
