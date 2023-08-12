<div class="modal-header">
    <h5 class="modal-title">{{ isset($record->id) ? __('Edit') : __('Add')}}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form method="POST" action="{{route('front_appointment-store')}}" id="appointment-form" enctype="multipart/form-data" data-parsley-validate="">
            @csrf
                <div class="row m-0">
                    <div class="col-12 col-sm-6">
                        <div class="mb-5">
                            <label for="exampleInputEmail1" class="form-label">YOUR NAME</label>
                            <input type="text" class="form-control" id="name" name="name" required="" placeholder="Enter Your Name" aria-describedby="nae">
                            @if ($errors->has('name')) <div class="text-warning">{{ $errors->first('name') }}</div>@endif
                        </div>
                        <div class="mb-5">
                            <label for="exampleInputEmail1" class="form-label">YOUR PHONE</label>
                            <input type="text" class="form-control num_only" id="phone" maxlength="10" name="phone" placeholder="Enter Your Phone Number" aria-describedby="nae">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-5">
                            <label for="exampleInputEmail1" class="form-label">YOUR EMAIL</label>
                            <input type="email" class="form-control" id="email" required="" name="email" placeholder="Enter Your Email" aria-describedby="emailHelp">
                            @if ($errors->has('email')) <div class="text-warning">{{ $errors->first('email') }}</div>@endif
                        </div>
                        <div class="mb-5">
                            <label for="exampleInputEmail1" class="form-label">YOUR SERVICE</label>
                            <select class="form-select" id="service" required="" name="service" aria-label="Default select example">
                                <option selected disabled>Open this select menu</option>
                                @foreach($scategories as $value)
                                    <option value="{{$value->id}}" {{isset($scategories->id) && $scategories->id == $value->id ? 'selected' : (old('id') && old('id') == $value->id ? 'selected' : '')}}>{{$value->title}}</option>
                                @endforeach
                                <!-- <option value="2">Two</option>
                                <option value="3">Three</option> -->
                            </select>
                            @if ($errors->has('service')) <div class="text-warning">{{ $errors->first('service') }}</div>@endif
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">YOUR MESSAGE</label>
                    <textarea class="form-control" id="message" name="message" rows="1" required=""></textarea>
                    @if ($errors->has('message')) <div class="text-warning">{{ $errors->first('message') }}</div>@endif
                  </div>
                <input type="submit" class="form-btn-contant" value="Send Message">
          </form>