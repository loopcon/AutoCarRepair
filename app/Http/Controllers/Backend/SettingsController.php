<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Constant;
use Auth;
use DB;
use Session;

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
}
