<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use Auth;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use App\Constant;
use DataTables;

class FaqController extends MainController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $return_data = array();       
        $return_data['site_title'] = trans('FAQ');
        return view('backend.faq.list', array_merge($this->data, $return_data));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $return_data = array();
        $return_data['site_title'] = trans('Faq Create');
        return view('backend.faq.form',array_merge($this->data,$return_data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'name' => ['required'],
                'description' => ['required'],
            ],[
                'required'  => trans('The :attribute field is required.')
            ]
        );
        $slug = $request->name != '' ? slugify($request->name) : NULL;
        $faq = Faq::create([
            'slug' => $slug,
            'name' => $request->name ? strip_tags($request->name) : NULL,
            'description' => $request->description,
            'created_by' => Auth::guard('admin')->user()->id,
            'updated_by' => NULL,
        ]);
        if($faq){
            return redirect('backend/faq')->with('success', trans('FaqPage Added Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = Crypt::decrypt($id);
        $return_data = array();
        $faq = Faq::find($id);
        $return_data['record'] = $faq;
        $return_data['site_title'] = trans('Faq Edit');
        return view('backend.faq.form', array_merge($this->data, $return_data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $id = Crypt::decrypt($id);
        $this->validate($request, [
                'name' => ['required'],
                'description' => ['required'],
            ],[
                'required'  => trans('The :attribute field is required.')
            ]
        );

        $slug = $request->name != '' ? slugify($request->name) : NULL;

        $faq = Faq::where('id', $id)->update([
                'slug' => $slug,
                'name' => $request->name ? strip_tags($request->name) : NULL,
                'description' => $request->description,
                'updated_by' => Auth::guard('admin')->user()->id,
            ]);
        if($faq) {
            return redirect('backend/faq')->with('success', trans('Faq Updated Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = Crypt::decrypt($id);
        $faq = Faq::where('id', $id)->update([
            'is_archive' => Constant::NOT_ARCHIVE,
            'updated_by' => Auth::guard('admin')->user()->id,
        ]);
        if($faq) {
            return redirect('backend/faq')->with('success', trans('Page Deleted Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }

    public function faqDatatable(request $request)
    {
        if($request->ajax()){
            $roles = Session::get('roles');
            $query = Faq::select('id', 'name','description')->where('is_archive', '=', Constant::ARCHIVE)->orderBy('id', 'DESC');
            $list = $query->get();

            return DataTables::of($list)
                ->addColumn('action', function ($row) {
                    $roles = Session::get('roles');
                    $html = "";
                    $id = Crypt::encrypt($row->id);
                    $html .= "<span class='text-nowrap'>";
                    $html .= "<a href='".route('admin_faq-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                    $html .= "<a href='javascript:void(0);' data-href='".route('admin_faq-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>";
                    $html .= "</span>";
                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return redirect('backend/dashboard');
        }
    }
}
