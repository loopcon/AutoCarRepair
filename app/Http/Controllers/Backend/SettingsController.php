<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\PickUpSlotSetting;
use App\Constant;
use Auth;
use DB;
use Session;
use Crypt;

class SettingsController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $return_data = array();
        $return_data['settings'] = Setting::orderBy('id', 'asc')->get();
        $return_data['site_title'] = trans('General Settings');
        return view('backend.setting.general', array_merge($this->data, $return_data));
    }

    public function update(Request $request)
    {
        $settings = Setting::orderBy('id', 'asc')->get();
        if($settings->count()){
            foreach ($settings as $value) {
                $name = $value->id;
                DB::table('settings')
                    ->where('id', $value->id)
                    ->update(['value' => $request->$name, 'updated_by' => Auth::guard('admin')->user()->_id]);
            }
        }
        return redirect('backend/site-settings')->with('success', trans('General settings updated successfully!'));
    }

    public function pickUpSlotSetting(request $request){
        $return_data = array();
        $return_data['slots'] = PickUpSlotSetting::orderBy('id', 'asc')->get();
        $return_data['site_title'] = trans('Pick Up Slot Settings');
        return view('backend.setting.pick_up_slot', array_merge($this->data, $return_data));
    }

    public function pickUpSlotSettingUpdate(request $request){
        $return_data = array();       
        $total = $request->last_id;
        if($total){
            for($i = 0; $i < $total; $i++){
                $id = 'id_'.$i;
                $time = 'time_'.$i;
                $slot = 'slot_'.$i;
                if(isset($request->$time) && isset($request->$slot)){
                    $request->$time = str_replace(' ', '', $request->$time);
                    $squery = PickUpSlotSetting::select('id')->where([['time', $request->$time]]);
                    if($request->$id){
                        $squery->where('id', '!=', $request->$id);
                    }
                    $sdata = $squery->first();
                    if(!isset($sdata->id)){
                        if($request->$id){
                            $id_val = Crypt::decrypt($request->$id);
                            $ssetting = PickUpSlotSetting::find($id_val);
                            $ssetting->updated_by = Auth::guard('admin')->user()->id;
                        } else {
                            $ssetting = new PickUpSlotSetting();
                            $ssetting->created_by = Auth::guard('admin')->user()->id;
                        }

                        $ssetting->time = $request->$time ? strip_tags($request->$time) : NULL;
                        $ssetting->slot = $request->$slot;
                        $ssetting->save();
                    }
                }
            }
            return redirect()->back()->with('success', trans('Pick Up Slot Settings Updated Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }

    public function pickUpSlotDelete(request $request){
        PickUpSlotSetting::where('id', $request->id)->delete();
    }
}
