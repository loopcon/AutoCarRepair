<div class="modal-header">
    <h5 class="modal-title">{{ isset($record->id) ? __('Edit') : __('Add')}}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form method="POST" action="@if(isset($record->id)){{ route('admin_car-model-update', array('id' => Crypt::encrypt($record->id))) }}@else{{route('admin_car-model-store')}}@endif" id="page-form" enctype="multipart/form-data" data-parsley-validate="">
    {{ csrf_field() }}
    <div class="modal-body m-3" id="form-detail">
        <input type="hidden" name="id" id="id" value="{{ isset($record->id) ? Crypt::encrypt($record->id) : '' }}">
        <div class="form-row">
            <div class="mb-3 col-md-6">
                <label class="form-label" for="carbrand_id">{{__('Car Maker')}}<span class="text-danger">*</span></label><br/>
                <select class="form-select select2" name='carbrand_id' required>
                    <option value="">{{__('-- select --')}}</option>
                    @if($brand->count())
                        @foreach($brand as $value)
                            <option value="{{$value->id}}" @if(isset($record->carbrand_id) && $record->carbrand_id == $value->id){{'selected'}}@endif>{{$value->title}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            
            <div class="mb-3 col-md-6">
                <label class="form-label" for="title">{{__('Title')}}<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" placeholder="{{__('Title')}}" maxlength="50" required=""  data-parsley-required-message="{{ __("This value is required.")}}" value="{{ isset($record->title) ? $record->title : old('title') }}">
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
    </div>
</form>

