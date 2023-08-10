<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use App\Models\OfferSlider;
use App\Constant;
use Auth;

class OfferSliderController extends MainController
{
    public function index()
    {
        $return_data = array();
        $return_data['site_title'] =trans('Offer Slider');
        $slider = OfferSlider::where([['is_archive',constant::NOT_ARCHIVE]])->orderBy('id','asc')->get();
        $return_data['slider'] = $slider;
        return view('backend.offer_slider.form',array_merge($this->data,$return_data));
    }

    public function sliderAjaxHtml(request $request)
    {
        if($request->ajax()){
            $html = view('backend.offer_slider.ajax_html',array('i' => $request->id))->render();
            echo json_encode(array('html' => $html));
            exit;
        } else {
            return redirect('backend/dashboard');
        }
    }

    public function slideupdate(Request $request)
    {
        $total_images = isset($request->last_id) && $request->last_id ? $request->last_id : NULL;
            if($total_images){
                for($i = 0; $i < $total_images; $i++){
                    $name = 'image'.$i;
                    $pid = 'sid'.$i;
                    if($request->hasFile($name)) {
                        $newName = fileUpload($request, $name, 'uploads/offerslider/');
                        if($request->$pid){
                            $product_img = OfferSlider::find($request->$pid);
                            $old_image = $product_img->image;
                            $title1 = $request->title1;
                            $title2 = $request->title2;
                            $btn_title = $request->btn_title;
                            $btn_link = $request->btn_link;
                            if($old_image){
                                removeFile('uploads/product/'.$id.'/'.$old_image);
                            }
                        } else {
                            $product_img = new OfferSlider();
                        }
                        $product_img->image = $newName;
                        $title1 = $request->title1;
                        $title2 = $request->title2;
                        $btn_title = $request->btn_title;
                        $btn_link = $request->btn_link;
                        $product_img->save();
                    }
                }
            return redirect()->back()->with('success', trans('Offer Slider Updated Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }
}
