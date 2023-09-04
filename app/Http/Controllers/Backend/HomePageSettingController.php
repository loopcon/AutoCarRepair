<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomePageSetting;
use App\Models\BrandLogoSlider;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
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
            $old_image = isset($content->section1_image) ? $content->section1_image : NULL;
            if($old_image){
                removeFile('uploads/content/'.$old_image);
            }
            $newName = fileUpload($request, 'section1_image', 'uploads/content');
            $content->section1_image = $newName;
        }
        $content->section1_title1 = $request->section1_title1;
        $content->section1_title2 = $request->section1_title2;
        $content->footer_description = $request->footer_description;
        $content->button_title = $request->button_title;
        $content->button_link = $request->button_link;
        $content->section1_description = $request->section1_description;
        $content->price_list = $request->price_list;
        $content->meta_title = $request->meta_title;
        $content->image_title = $request->image_title;
        $content->meta_keywords = $request->meta_keywords;
        $content->meta_description = $request->meta_description;
        $content->updated_by = Auth::guard('admin')->user()->id;
        $content->save();
        if($content) {
            return redirect('backend/home-page-content')->with('success', trans('Content Updated Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }

    public function brandLogoSlider()
    {
        $return_data = array();
        $return_data['site_title'] = trans('Brand Logo Slider');
        $return_data['brandslider'] = BrandLogoSlider::orderBy('id', 'asc')->get();
        return view('backend.homepagesetting.brand_logo_slider',array_merge($this->data,$return_data));
    }

    public function slideupdate(Request $request)
    {
        $return_data = array();       
        $total = $request->last_id;
        if($total){
            for($i = 0; $i < $total; $i++){
                $id = 'id_'.$i;
                $image = 'image_'.$i;
                $image_title = 'image_title_'.$i;
                if(isset($request->$id)){
                    $image = 'image_'.$i;
                    $image_title = 'image_title_'.$i;
                    if($request->$id){
                        $id_val = Crypt::decrypt($request->$id);
                        $brand_slider = BrandLogoSlider::find($id_val);
                        $brand_slider->updated_by = Auth::guard('admin')->user()->id;
                    } else {
                        $brand_slider = new BrandLogoSlider();
                        $brand_slider->created_by = Auth::guard('admin')->user()->id;
                    }
                    // if($request->hasFile($image)) {
                    //     if($request->$id){
                    //         $old_image = $brand_slider->image;
                    //         if($old_image){
                    //             removeFile('uploads/brandlogoslider/'.$old_image);
                    //         }
                    //     }
                    //     $newName = fileUpload($request, $image, 'uploads/brandlogoslider/');
                    //     $brand_slider->image = $newName;
                    // }
                    $brand_slider->image = $request->$image ? $request->$image : NULL;
                    $brand_slider->image_title = $request->$image_title ? $request->$image_title : NULL;
                    $brand_slider->save();
                }
            }   
            return redirect()->back()->with('success', trans('Brand Logo Slider Updated Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }

    public function slideDelete(request $request)
    {
        // $brand_slider = BrandLogoSlider::where('id', $request->id)->first();
        // $old_image = $brand_slider->image;
        // if($old_image){
        //     removeFile('uploads/brandlogoslider/'.$old_image);
        // }
        BrandLogoSlider::where('id', $request->id)->delete();
    }
}

