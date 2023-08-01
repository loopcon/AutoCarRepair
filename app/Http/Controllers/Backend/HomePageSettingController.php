<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomePageSetting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;
use Session;
use DB;

class HomePageSettingController extends MainController
{
    public function index()
    {
        $return_data = array();       
        $return_data['site_title'] = trans('Home Page Content');
        $return_data['record'] = HomePageSetting::find(1);
        return view('backend.homepagesetting.index', array_merge($this->data, $return_data));
    }

    public function update(request $request)
    {
        $content = HomePageSetting::find(1);
        if($request->hasFile('section1_image')) {
            $old_image = isset($ads->section1_image) ? $ads->section1_image : NULL;
            if($old_image){
                removeFile('uploads/content/'.$old_image);
            }
            $newName = fileUpload($request, 'section1_image', 'uploads/content');
            $content->section1_image = $newName;
        }
        $content->section1_title1 = $request->section1_title1;
        $content->section1_title2 = $request->section1_title2;
        $content->section1_description = $request->section1_description;
        $content->updated_by = Auth::guard('admin')->user()->id;
        $content->save();
        if($content) {
            return redirect('backend/home-page-content')->with('success', trans('Content Updated Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }
}
