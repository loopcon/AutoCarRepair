<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAddress;
use Auth;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use App\Constant;
use DataTables;

class UserController extends MainController
{
    public function index()
    {
        $return_data = array();       
        $return_data['site_title'] = trans('Users');
        return view('backend.user.list', array_merge($this->data, $return_data));
    }

    //listing 
    public function userDatatable(request $request)
    {
        if($request->ajax()){
            $roles = Session::get('roles');
            $query = User::select('id', 'firstname','lastname','email','phone','address')->where('is_archive', '=', Constant::NOT_ARCHIVE)->orderBy('id', 'DESC');
            $list = $query->get();

            return DataTables::of($list)
                ->addColumn('action', function ($row) {
                    $roles = Session::get('roles');
                    $html = "";
                    $id = Crypt::encrypt($row->id);
                    $html .= "<span class='text-nowrap'>";
                    $html .= "<a href='javascript:void(0);' data-href='".route('admin_user-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm mr-20 delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                    $html .= "<a href='".route('admin_user-address',array($row->id))."' rel='tooltip' title='Address' class='btn btn-success btn-sm'>Address</i></a>";
                    $html .= "</span>";
                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return redirect('backend/dashboard');
        }
    }

    public function destroy(string $id)
    {
        $id = Crypt::decrypt($id);
        $user = User::where('id', $id)->delete();
        if($user) {
            return redirect('backend/user')->with('success', trans('User Deleted Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }

    public function address(request $request,$id){
        $return_data = array();       
        $return_data['site_title'] = trans('User Address');
        $user_id = $request->user_id;
        // print_r($user_id);exit;
        // $record = User::select('id','address','firstname','zipcode','city')->where([['id', $user_id], ['is_archive', Constant::NOT_ARCHIVE]])->first();
        // $return_data['record'] = $record;
        return view('backend.user.address', array_merge($this->data, $return_data));
    }

    public function userAddressDatatable(request $request)
    {  
        if($request->ajax()){
            $query = UserAddress::select('id','user_id','address','zip','city')->with('userDetail')->where('user_id', $request->id);
            $list = $query->get();

            return DataTables::of($list)
                ->addColumn('address', function ($row) {
                    $html = $row->address;
                    return $html;
                })
                ->addColumn('user', function($row) {
                    return $row->userDetail->firstname;
                })
                ->addColumn('action', function ($row) {
                    $html = "";
                    $id = Crypt::encrypt($row->id);
                    $html .= "<span class='text-nowrap'>";
                    $html .= "<a href='javascript:void(0);' data-href='".route('admin_user-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm mr-20 delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                    $html .= "</span>";
                    return $html;
                })
                ->rawColumns(['id','firstname','address','zipcode','city','action'])
                ->make(true);
        } else {
            return redirect('backend/dashboard');
        }
    }
}
