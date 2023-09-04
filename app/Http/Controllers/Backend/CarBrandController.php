<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\CarBrand;
use Auth;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use App\Constant;
use DataTables;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportCarbrand;
use App\Imports\ImportCarBrand;

class CarBrandController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $return_data = array();       
        $return_data['site_title'] = trans('Car Brand');
        return view('backend.carbrand.list', array_merge($this->data, $return_data));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => [
                'required',
                Rule::unique('car_brands')->where(function ($query) use($request) {
                    return $query->where('is_archive', Constant::NOT_ARCHIVE);
                }),
            ],
        ]
        );
        $slug = $request->title != '' ? slugify($request->title) : NULL;

        $carbrand = new CarBrand();
        $fields = array('title');
        foreach($fields as $field){
            $carbrand->$field = isset($request->$field) && $request->$field ? $request->$field : NULL;
        }
        // if($request->hasFile('image')) {
        //     $newName = fileUpload($request, 'image', 'uploads/carbrand');
        //     $carbrand->image = $newName;
        // }
        $carbrand->slug = $slug;
        if ($request->has('image')) {
            $originalImageLink = $request->image;
            
            if (preg_match('/\/d\/(.*?)\//', $originalImageLink, $matches)) {
                $fileId = $matches[1];
                $directImageLink = "https://drive.google.com/uc?export=download&id={$fileId}";
                $carbrand->image = $directImageLink;
            } else {
                // If it's not a Google Drive link, use it as is
                $carbrand->image = $originalImageLink;
            }
        }
        $carbrand->created_by = Auth::guard('admin')->user()->id;
        $carbrand->save();
        if($carbrand){
            return redirect()->back()->with('success', trans('Car Brand Added Successfully!'));
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
    public function ajaxEditCarBrandHtml(request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $id = $id ? Crypt::decrypt($id) : NULL;
            $record = $id ? CarBrand::find($id) : NULL;
            $html = view('backend.carbrand.ajax_edit_html', array('record' => $record))->render();
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
    public function update(Request $request, $id)
    {

        $id = Crypt::decrypt($id);
        $this->validate($request, [
                'title' => [
                    'required',
                    Rule::unique('car_brands')->where(function ($query) use($request, $id) {
                        return $query->where([['is_archive', Constant::NOT_ARCHIVE],['id', '!=', $id]]);
                    }),
                ],
            ]
        );
        $slug = $request->title != '' ? slugify($request->title) : NULL;

        $carbrand = CarBrand::find($id);
        $fields = array('title');
        foreach($fields as $field){
            $carbrand->$field = isset($request->$field) && $request->$field ? $request->$field : NULL;
        }
        if ($request->has('image')) {
            $originalImageLink = $request->image;
            
            if (preg_match('/\/d\/(.*?)\//', $originalImageLink, $matches)) {
                $fileId = $matches[1];
                $directImageLink = "https://drive.google.com/uc?export=download&id={$fileId}";
                $carbrand->image = $directImageLink;
            } else {
                // If it's not a Google Drive link, use it as is
                $carbrand->image = $originalImageLink;
            }
        }
        $carbrand->slug = $slug;
        $carbrand->updated_by = Auth::guard('admin')->user()->id;
        $carbrand->save();

        if($carbrand) {
            return redirect()->back()->with('success', trans('Car Brand Updated Successfully!'));
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
    public function destroy(Request $request,$id)
    {
    $id = Crypt::decrypt($id);
       $constraint_array = array(
           array('table' => 'model', 'column' => 'carbrand_id')
       );
       $is_delete = checkDeleteConstrainnt($constraint_array, $id);
       if($is_delete) {
            $image = CarBrand::where('id', $id)->first();
            $old_image = $image->image;
            if($old_image){
                removeFile('uploads/carbrand/'.$old_image);
            }

            $carbrand = CarBrand::where('id', $id)->delete();
            if($carbrand) {
                return redirect()->back()->with('success', trans('Car Brand Deleted Successfully!'));
            } else {
                return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
            }
       } else {
           return redirect()->back()->with('error', trans('You can not delete this car brand! Somewhere this car brand information is added in system!'));
       }
    }
    public function carbrandsDatatable(request $request)
    {
        if($request->ajax()){
            $query = CarBrand::select('id', 'title', 'image', 'status')->where('is_archive', '=', Constant::NOT_ARCHIVE)->orderBy('id', 'DESC');
            $list = $query->get();

            return DataTables::of($list)
                ->addColumn('image', function ($row) {
                    $image = $row->image ? "<img src='".url($row->image)."' width='80px' height='80px'>" : '';
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
                    $html .= "<a href='javascript:void(0);' data-href='".route('admin_car-brand-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
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
    
    public function changeCarBrandStatus(request $request){
        if($request->ajax()){
            $id = Crypt::decrypt($request->id);
            $message = $request->status == Constant::ACTIVE ? 'Car Brand Activated Successfully!' : 'Car Brand Inactivated Successfully!';
            CarBrand::where([['id', $id]])->update(array('status' => $request->status, 'updated_by' => Auth::guard('admin')->user()->id)); 
            echo json_encode(array('message' => $message));
            exit;
        } else {
            return redirect('backend/dashboard');
        }
    }

    public function export(Request $request){
        return Excel::download(new ExportCarbrand, 'Car_Brand_Sample.csv');
    }

    
    //use when import from another tab(browser)....not by pop-up
    // public function importAdd()
    // {
    //     $return_data = array();
    //     $return_data['site_title'] = trans('Import Data');
    //     return view('backend.carbrand.import', array_merge($this->data, $return_data));
    // }

    public function import(Request $request){
        $request->validate([
            'file' => 'required|max:10000',
        ]);

        $path = $request->file('file')->store('files'); 

        Excel::import(new ImportCarBrand,$path);
        return redirect('backend/car-brand')->with('success', trans('Car Brand Imported successfully.'));
    }
}
