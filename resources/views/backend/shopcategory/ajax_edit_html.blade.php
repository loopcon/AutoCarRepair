<style>
    .image_errortext{
        color:red;
        font-size:10px;
        white-space: nowrap;
    }
</style>
<div class="modal-header">
    <h5 class="modal-title">{{ isset($record->id) ? __('Edit') : __('Add')}}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form method="POST" action="@if(isset($record->id)){{ route('admin_shop-category-update', array('id' => Crypt::encrypt($record->id))) }}@else{{route('admin_shop-category-store')}}@endif" id="page-form" enctype="multipart/form-data" data-parsley-validate="">
    {{ csrf_field() }}
    <div class="modal-body m-3" id="form-detail">
        <input type="hidden" name="id" id="id" value="{{ isset($record->id) ? Crypt::encrypt($record->id) : '' }}">
        <div class="form-row">
            <div class="mb-3 col-md-6">
                <label class="form-label" for="name">{{__('Category Name')}}<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="{{__('Category Name')}}" maxlength="50" required=""  data-parsley-required-message="{{ __("This value is required.")}}" value="{{ isset($record->name) ? $record->name : old('name') }}">
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
    </div>
</form>