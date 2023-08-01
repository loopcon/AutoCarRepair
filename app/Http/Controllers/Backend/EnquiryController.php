<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Auth;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use App\Constant;
use DataTables;

class EnquiryController extends MainController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $return_data = array();       
        $return_data['site_title'] = trans('Enquires');
        return view('backend.enquiry.list', array_merge($this->data, $return_data));
    }

    //listing 
    public function enquiryDatatable(request $request)
    {
        if($request->ajax()){
            $roles = Session::get('roles');
            $query = Enquiry::select('id', 'name','email','phone','service','message')->where('is_archive', '=', Constant::NOT_ARCHIVE)->orderBy('id', 'DESC');
            $list = $query->get();

            return DataTables::of($list)
                ->addColumn('action', function ($row) {
                    $roles = Session::get('roles');
                    $html = "";
                    $id = Crypt::encrypt($row->id);
                    $html .= "<span class='text-nowrap'>";
                    $html .= "<a href='javascript:void(0);' data-href='".route('admin_enquiry-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>";
                    $html .= "</span>";
                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return redirect('backend/dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Enquiry $enquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enquiry $enquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enquiry $enquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $id = Crypt::decrypt($id);
        $enquiry = Enquiry::where('id', $id)->delete();
        if($enquiry) {
            return redirect('backend/enquiry')->with('success', trans('Enquiry Deleted Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }
}
