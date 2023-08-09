<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\States;
use Illuminate\Support\Facades\Validator;
use App\Constant;
use Auth;
use DB;

class UserController extends MainController
{
    public function myprofile(Request $request)
    {
        $return_data = array();
        $return_data['settings'] = $this->data;
        $return_data['site_title'] = trans('User Profile');
        $user_id = Auth::guard('user')->user()->id;
        $return_data['states'] = States::select('id','name')->orderBy('id','DESC')->get();
        $addresses = UserAddress::select('id','address', 'zip', 'city','state')->where('user_id',$user_id)->get();
        $return_data['addresses'] = $addresses;
        return view('front.auth.myprofile',array_merge($this->data,$return_data)); 
    } 

    public function myprofileUpdate(request $request)
    {
        $user_id = auth()->user()->id;
        $this->validate($request, [
            'email' => [
                'required',
                Rule::unique('users')->where(function ($query) use($request, $user_id) {
                    return $query->where([['is_archive', Constant::NOT_ARCHIVE], ['id', '!=', $user_id]]);
                }),
            ],
        ]);

        $user =User::find($user_id);
        if($request->file('image')) {                     
            $old_image = auth()->user()->image;
            if($old_image){
                removeFile('uploads/user/'.$old_image);
            }
            $newName = fileUpload($request, 'image', 'uploads/user');
            $user->image = $newName;
        }
        $fields = array('firstname', 'lastname', 'phone', 'email');
        foreach($fields as $field){
            $user->$field = isset($request->$field) && $request->$field != '' ? $request->$field : NULL;
        }
        $user->updated_by = Auth::guard('user')->user()->id;
        $user->save();
        if($user)
        {
            $address = $request->address;
            if($address){
                foreach($address as $key=>$value){
                    $city = isset($request->city) ? $request->city : array();
                    $state = isset($request->state) ? $request->state : array();
                    $zip = isset($request->zip) ? $request->zip : array();
                    $aid = isset($request->aid) ? $request->aid : array();

                    if($value){
                        if(isset($aid[$key]) && $aid[$key]){
                            $user_address = UserAddress::find($aid[$key]);
                        } else {
                            $user_address = new UserAddress();
                        }
                        $user_address->address = $value;
                        $user_address->city = isset($city[$key]) && $city[$key] ? $city[$key] : NULL;
                        $user_address->state = isset($state[$key]) && $state[$key] ? $state[$key] : NULL;
                        $user_address->zip = isset($zip[$key]) && $zip[$key] ? $zip[$key] : NULL;
                        $user_address->user_id = $user->id;
                        $user_address->save();
                    }
                    
                }
            }
            return redirect('my-profile')->with('success', trans('User Updated Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }
}
