<div class="row image-row image-{{$i}} mb-2">
    <div class="col-12">
        <hr/>
    </div>
    <div class="col-md-4 pl-0">
        <input type="hidden" name="pid{{$i}}" value="">
        <div class="profile-icon">
            <img class='img-responsive img-fluid' id="uploadPreview{{$i}}" src="{{url('public/no.jpg')}}"  alt=''>
        </div>
        <div class="m-b-10">
            <input type="file" id="uploadImage{{$i}}" accept="image/x-png, image/gif, image/jpeg" class="btn btn-warning btn-block btn-sm"  name="image{{$i}}" data-parsley-required-message="{{ __("This value is required.")}}" onChange="this.parentNode.nextSibling.value = this.value; PreviewImage({{$i}});" >
        </div>
    </div>
    <div class="mt-3 col-md-3">
        <input type="text" class=""  name="image_title{{$i}}" placeholder="{{__('Image Title')}}">
    </div>
    <div class="col-md-2 pl-0 text-end">
        <br/><input type="radio" class="" value="{{$i}}" name="is_primary" />
    </div>
    <div class="col-md-2 pl-0 text-end">
        <br/><span class="btn btn-danger btn-sm delete" data-id="{{$i}}" data-db_id="0"><i class="fas fa-trash"></i></span>
    </div>
</div>