
<div class="row image-row image{{$i}} mb-2">
    <div class="col-12">
        <hr/>
    </div>
    <div class="col-md-4">
        <input type="hidden" name="sid{{$i}}" value="">
        <label class="form-label" for="image">{{__('Image')}}<span class="text-danger">*</span></label>
        <div class="profile-icon">
            <img class='img-responsive img-fluid' id="uploadPreview{{$i}}" src="{{url('public/no.jpg')}}"  alt=''>
        </div>
        <div class="m-b-5">
            <input type="file" id="uploadImage{{$i}}" accept="image/x-png, image/gif, image/jpeg" class="btn btn-warning btn-block btn-sm"  name="image{{$i}}" data-parsley-required-message="{{ __("This value is required.")}}" onChange="this.parentNode.nextSibling.value = this.value; PreviewImage({{$i}});" >
        </div>
    </div>
    <div class="col-md-4">
        <label class="form-label" for="title1">{{__('Title 1')}}<span class="text-danger">*</span></label>        
        <br/><input type="text" class="form-control" value="" name="title1" />
    </div>
    <div class="col-md-4">
        <label class="form-label" for="image">{{__('Title 2')}}<span class="text-danger">*</span></label>        
        <br/><input type="text" class="form-control" value="" name="title2" />
    </div>
    <div class="col-md-4 ">
        <label class="form-label" for="btn_title">{{__('Button Title')}}<span class="text-danger">*</span></label>        
        <input type="text" class="form-control" value="" name="btntitle" />
    </div>
    <div class="col-md-4">
        <label class="form-label" for="btn_link">{{__('Button Link')}}<span class="text-danger">*</span></label>        
        <br/><input type="text" class="form-control" value="" name="btnlink" />
    </div>
    <div class="col-md-12 pl-0 text-end">
        <br/><a href="javascript:void(0)" data-db_id="0" data-id="{{$i}}" class="btn btn-danger delete">Delete Below Data</a>
    </div>
    
</div>