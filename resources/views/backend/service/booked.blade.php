@extends('backend.layout.main')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('public/plugins/sweetalert/sweetalert.css')}}">
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
                        <div class = "row">
                            <div class="form-group col-md-3 select-parsley">
                                <label for="package">Scheduled Packages</label>
                                <select id="package" class="form-control select2" name="package">
                                    <option value="all" selected>--Select--</option>
                                    @if($packages->count())
                                        @foreach($packages as $value)
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
                        <table id="bservices" class="table table-striped table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>{{__('Id')}}</th>
                                    <th>{{__('Order No')}}</th>
                                    <th>{{__('User')}}</th>
                                    <th>{{__('Phone No')}}</th>
                                    <th>{{__('Service')}}</th>
                                    <th>{{__('Booked Date')}}</th>
                                    <th>{{__('Time')}}</th>
                                    <th>{{__('Time Takes')}}</th>
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
<script>
$(document).ready(function() {
    $('.select2').select2();
    var bservices = $("#bservices").DataTable({
        "sScrollX": '100%',
        "order": [], //Initial no order.
        "aaSorting": [],
        processing: true,
        serverSide: true,
        "pageLength": 100,
        "lengthMenu": [[50, 100, 200, 400], [50, 100, 200, 400]],
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'order_no', name: 'order_no'},
            {data: 'user', name: 'user'},
            {data: 'phone', name: 'phone'},
            {data: 'service', name: 'service'},
            {data: 'booked_date', name: 'booked_date'},
            {data: 'time', name: 'time'},
            {data: 'time_takes', name: 'time_takes'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        "ajax" : {
            url : "{{ route('admin_booked-service-datatable') }}",
            type : "POST",
            data : function(d) {
                d._token = "{{ csrf_token() }}",
                d.package = $('#package').val(),
                d.brand = $('#brand').val(),
                d.model_id = $('#carModel').val(),
                d.fuel_type = $('#fuelType').val(),
                d.od_id = "{{isset($od_id) ? $od_id : ''}}"
            }
        }
    });

    $(document).on('change', '#package, #brand, #carModel, #fuelType', function(){
        bservices.ajax.reload();
    });
});
</script>
@endsection

