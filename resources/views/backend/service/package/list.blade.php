@extends('backend.layout.main')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('public/plugins/sweetalert/sweetalert.css')}}">
    <link class="js-stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('content')

<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                @include('backend.alerts')
            </div>
        </div>
        <h1 class="h3 mb-3">{{$site_title}}</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="form-row">
                            <div class="col-md-12 text-end">
                                <div class="col-md-12 text-end"><a href="{{route('admin_scheduled-package-create')}}" class="btn btn-success"><i class="align-middle" data-feather="plus"></i>{{__('Add')}}</a></div>
                            </div>
                        </div>
                        <div class = "row">
                            <div class="form-group col-md-2 select-parsley">
                                <label for="serviceCategory">Category</label>
                                <select id="serviceCategory" class="form-control select2" name="serviceCategory">
                                    <option value="all" selected>--Select--</option>
                                    @if($categories->count())
                                        @foreach($categories as $value)
                                            <option value="{{$value->id}}">{{$value->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-2 select-parsley">
                                <label for="brand">Brand</label>
                                <select id="brand" class="form-control select2" name="brand">
                                    <option value="all" selected>--Select--</option>
                                    @if($brands->count())
                                        @foreach($brands as $value)
                                            <option value="{{$value->id}}">{{$value->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-2 select-parsley">
                                <label for="carModel">Car Model</label>
                                <select id="carModel" class="form-control select2" name="carModel">
                                    <option value="all" selected>--Select--</option>
                                    @if($models->count())
                                        @foreach($models as $value)
                                            <option value="{{$value->id}}">{{$value->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-2 select-parsley">
                                <label for="fuelType">Fuel Type</label>
                                <select id="fuelType" class="form-control select2" name="fuelType">
                                    <option value="all" selected>--Select--</option>
                                    @if($fuel_type->count())
                                        @foreach($fuel_type as $value)
                                            <option value="{{$value->id}}">{{$value->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>{{__('Id')}}</th>
                                    <th>{{__('Image')}}</th>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Category')}}</th>
                                    <th>{{__('Car Detail')}}</th>
                                    <th>{{__('Note')}}</th>
                                    <th>{{__('Time Takes')}}</th>
                                    <th>{{__('Price')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('javascript')
<script src="{{asset('plugins/sweetalert/sweetalert.js')}}" type="text/javascript"></script>
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#serviceCategory').select2();
    $('#brand').select2();
    $('#carModel').select2();
    $('#fuelType').select2();
    var table = $("#table").DataTable({
        "order": [], //Initial no order.
        "aaSorting": [],
        processing: true,
        serverSide: true,
        "pageLength": 100,
        "lengthMenu": [[50, 100, 200, 400], [50, 100, 200, 400]],
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image'},
            {data: 'title', name: 'title'},
            {data: 'category', name: 'category'},
            {data: 'car_detail', name: 'car_detail'},
            {data: 'note', name: 'note'},
            {data: 'time_takes', name: 'time_takes'},
            {data: 'price', name: 'price'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        "ajax" : {
            url : "{{ route('admin_scheduled-package-datatable') }}",
            type : "POST",
            data : function(d) {
                d._token = "{{ csrf_token() }}"
                d.serviceCategory = $('#serviceCategory').val()
                d.brand = $('#brand').val()
                d.carModel = $('#carModel').val()
                d.fuelType = $('#fuelType').val()
            }
        }
    });

    $(document).on('change', '#serviceCategory', function(){
        table.ajax.reload();
    });
    $(document).on('change', '#brand', function(){
        table.ajax.reload();
    });
    $(document).on('change', '#carModel', function(){
        table.ajax.reload();
    });
    $(document).on('change', '#fuelType', function(){
        table.ajax.reload();
    });

    $(document).on('click', '.delete', function() {
        var href = $(this).data('href');
        swal({
            title: "",
            text: "{{__('Are you sure? Delete this scheduled package!')}}",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "{{__('Yes, delete it!')}}",
            cancelButtonText: "{{__('Cancel')}}",
            closeOnConfirm: true
        },
        function(){
            location.href = href;
        });
    });
});
</script>

@endsection