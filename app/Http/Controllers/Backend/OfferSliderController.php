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
        $return_data['slider'] = OfferSlider::orderBy('id', 'asc')->get();
        // $return_data['slider'] = $slider;
        return view('backend.offer_slider.index',array_merge($this->data,$return_data));
    }

    // public function sliderAjaxHtml(request $request)
    // {
    //     if($request->ajax()){
    //         $html = view('backend.offer_slider.ajax_html',array('i' => $request->id))->render();
    //         echo json_encode(array('html' => $html));
    //         exit;
    //     } else {
    //         return redirect('backend/dashboard');
    //     }
    // }

    public function slideupdate(Request $request)
    {
        $return_data = array();       
        $total = $request->last_id;
        if($total){
            for($i = 0; $i < $total; $i++){
                $id = 'id_'.$i;
                $name = 'image_'.$i;
                $title1 = 'title1_'.$i;
                $title2 = 'title2_'.$i;
                $btn_title = 'btn_title_'.$i;
                $btn_link = 'btn_link_'.$i;
                // $slot = 'slot_'.$i;
                if(isset($request->$title1) && isset($request->$title2) && isset($request->$btn_title)&& isset($request->$btn_link)){
                    $request->$title1 = str_replace(' ', '', $request->$title1);
                    $squery = OfferSlider::select('id')->where([['title1', $request->$title1]]);
                    if($request->$id){
                        $squery->where('id', '!=', $request->$id);
                    }
                    $sdata = $squery->first();
                    if(!isset($sdata->id)){
                        if($request->$id){
                            $id_val = Crypt::decrypt($request->$id);
                            $ssetting = OfferSlider::find($id_val);
                            if($request->hasFile($name)) {
                                $newName = fileUpload($request, $name, 'uploads/offer_slider/');
                                    $old_image = $ssetting->image;
                                    if($old_image){
                                        removeFile('uploads/offer_slider/'.$old_image);
                                    }
                                
                            }
                            $ssetting->updated_by = Auth::guard('admin')->user()->id;
                        } else {
                            $ssetting = new OfferSlider();
                            $ssetting->created_by = Auth::guard('admin')->user()->id;
                        }

                        $ssetting->title1 = $request->$title1 ? strip_tags($request->$title1) : NULL;
                        // $ssetting->image = $newName;
                        // $ssetting->slot = $request->$slot;
                        $ssetting->title2 = $request->$title2;
                        $ssetting->btn_title = $request->$btn_title;
                        $ssetting->btn_link = $request->$btn_link;
                        $ssetting->save();
                    }
                }
            }
            return redirect()->back()->with('success', trans('Pick Up Slot Settings Updated Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }
}
