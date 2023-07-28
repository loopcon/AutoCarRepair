<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Auth;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use App\Constant;
use DataTables;
use DB;

class ServiceController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function serviceCategoryList()
    {
        $return_data = array();       
        $return_data['site_title'] = trans('Service Category');
        return view('backend.service.category.list', array_merge($this->data, $return_data));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function serviceCategoryStore(Request $request)
    {
        $this->validate($request, [
            'title' => [
                'required',
                Rule::unique('service_categories')->where(function ($query) use($request) {
                    return $query->where('is_archive', Constant::NOT_ARCHIVE);
                }),
            ],
        ]
        );
        $slug = $request->title != '' ? slugify($request->title) : NULL;

        $scstegory = new ServiceCategory();
        $fields = array('title');
        foreach($fields as $field){
            $scstegory->$field = isset($request->$field) && $request->$field ? $request->$field : NULL;
        }
        if($request->hasFile('image')) {
            $newName = fileUpload($request, 'image', 'uploads/service/category');
            $scstegory->image = $newName;
        }
        $scstegory->slug = $slug;
        $scstegory->created_by = Auth::guard('admin')->user()->id;
        $scstegory->save();
        if($scstegory){
            return redirect()->back()->with('success', trans('Service Category Added Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ajaxEditServiceCategoryHtml(request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $id = $id ? Crypt::decrypt($id) : NULL;
            $record = $id ? ServiceCategory::find($id) : NULL;
            $html = view('backend.service.category.ajax_edit_html', array('record' => $record))->render();
            $return = array();
            $return['html'] = $html;
            echo json_encode($return);
        } else {
            return redirect('backend/dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function serviceCategoryUpdate(Request $request, $id)
    {

        $id = Crypt::decrypt($id);
        $this->validate($request, [
                'title' => [
                    'required',
                    Rule::unique('service_categories')->where(function ($query) use($request, $id) {
                        return $query->where([['is_archive', Constant::NOT_ARCHIVE],['id', '!=', $id]]);
                    }),
                ],
            ]
        );
        $slug = $request->title != '' ? slugify($request->title) : NULL;

        $scategory = ServiceCategory::find($id);
        $fields = array('title');
        foreach($fields as $field){
            $scategory->$field = isset($request->$field) && $request->$field ? $request->$field : NULL;
        }
        if($request->hasFile('image')) {
            $old_image = $scategory->image;
            if($old_image){
                removeFile('uploads/service/category/'.$old_image);
            }
            $newName = fileUpload($request, 'image', 'uploads/service/category');
            $scategory->image = $newName;
        }
        $scategory->slug = $slug;
        $scategory->updated_by = Auth::guard('admin')->user()->id;
        $scategory->save();

        if($scategory) {
            return redirect()->back()->with('success', trans('Service Category Updated Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function serviceCategoryDestroy($id)
    {
        $id = Crypt::decrypt($id);
//        $constraint_array = array(
//            array('table' => 'model', 'column' => 'carbrand_id')
//        );
//        $is_delete = checkDeleteConstrainnt($constraint_array, $id);
//        if($is_delete) {
            $scategory = ServiceCategory::where('id', $id)->update([
                'is_archive' => '0',
                'updated_by' => Auth::guard('admin')->user()->id,
            ]);
            if($scategory) {
                return redirect()->back()->with('success', trans('Service Category Deleted Successfully!'));
            } else {
                return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
            }
//        } else {
//            return redirect()->back()->with('error', trans('You can not delete this car brand! Somewhere this car brand information is added in system!'));
//        }
    }
    public function serviceCategoryDatatable(request $request)
    {
        if($request->ajax()){
            $query = ServiceCategory::select('id', 'title', 'image', 'status')->where('is_archive', '=', Constant::NOT_ARCHIVE)->orderBy('id', 'DESC');
            $list = $query->get();

            return DataTables::of($list)
                ->addColumn('image', function ($row) {
                    $image = $row->image ? "<img src='".url('uploads/service/category/'.$row->image)."' width='80px' height='80px'>" : '';
                    return $image;
                })
                ->addColumn('status', function ($row) {
                    $html = $row->status == Constant::ACTIVE ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
                    return $html;
                })
                ->addColumn('action', function ($row) {
                    $html = "";
                    $id = Crypt::encrypt($row->id);
                    $html .= "<span class='text-nowrap'>";
                    $html .= "<a href='javascript:void(0);' rel='tooltip' title='".trans('Edit')."' data-id='".$id."' class='btn btn-info btn-sm ajax-form'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                    $html .= "<a href='javascript:void(0);' data-href='".route('admin_service-category-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                    if($row->status == Constant::ACTIVE) {
                        $html .= "<a href='javascript:void(0);' class='btn btn-warning btn-sm status' data-status='".Constant::INACTIVE."' data-id='".$id."' rel='tooltip' title='Inactive'><i class='far fa-fw fa-window-close'></i></a>&nbsp";
                    } else {
                        $html .= "<a href='javascript:void(0);' class='btn btn-success btn-sm status' data-status='".Constant::ACTIVE."' data-id='".$id."' title='Active'><i class='fas fa-check'></i></a>";
                    }
                    $html .= "</span>";
                    return $html;
                })
                ->rawColumns(['image','action','status'])
                ->make(true);
        } else {
            return redirect('backend/dashboard');
        }
    }
    
    public function changeServiceCategoryStatus(request $request){
        if($request->ajax()){
            $id = Crypt::decrypt($request->id);
            $message = $request->status == Constant::ACTIVE ? 'Service Category Activated Successfully!' : 'Service Category Inactivated Successfully!';
            ServiceCategory::where([['id', $id]])->update(array('status' => $request->status, 'updated_by' => Auth::guard('admin')->user()->id)); 
            echo json_encode(array('message' => $message));
            exit;
        } else {
            return redirect('backend/dashboard');
        }
    }
}
