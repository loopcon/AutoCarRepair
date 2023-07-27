<?php

namespace App\Http\Controllers\Backend;

use App\Constant;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use Session;

class DashboardController extends MainController
{
    public function index() 
    {
        $return_data = array();
        $return_data['site_title'] = trans('Dashboard');
        return view('backend.dashboard.index', array_merge($this->data, $return_data));
    }

    public function showchangePasswordForm()
    {
        $return_data = array();
        $return_data['site_title'] = trans('Change Password');
        return view('backend.dashboard.change_password', array_merge($this->data, $return_data));
    }

    public function changePassword(Request $request)
    {
        $current_password = Auth::guard('admin')->user()->password;

        if(!\Hash::check($request->old_password, $current_password)){
            return back()->with('error',trans('You have entered wrong old password!'));
        } else {
            $user_id = Auth::guard('admin')->user()->id;
            $password = \Hash::make($request->new_password);
            DB::table('admins')->where('id', $user_id)->update(['password' => $password]);
            return redirect('backend/dashboard')->with('success', trans('Your password updated successfully!'));
        }
        
    }
}
