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
                                <!-- <a href='javascript:void(0);' data-href="{{ route('admin_deleteall') }}" class='btn btn-danger btn-sm mr-20 delete_all'>Delete All</a> -->
                                <button class="btn btn-danger selected_data">Delete Selected</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="user" class="table table-striped table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" id='checkAll' value="">
                                            <span class="form-check-label">
                                                All
                                            </span>
                                        </label>
                                    </th>
                                    <th>{{__('Firstname')}}</th>
                                    <th>{{__('Lastname')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Phone')}}</th>
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
    $("#checkAll").change(function() {
        if (this.checked) {
            $(".checkSingle").each(function() {
                this.checked=true;
            });
        } else {
            $(".checkSingle").each(function() {
                this.checked=false;
            });
        }
    });
    var page = $("#user").DataTable({
        "sScrollX": '100%',
        "order": [], //Initial no order.
        "aaSorting": [],
        processing: true,
        serverSide: true,
        "pageLength": 100,
        "lengthMenu": [[50, 100, 200, 400], [50, 100, 200, 400]],
        "columns": [
            { data: 'id', name: 'id', orderable: false, searchable: false },
            {data: 'firstname', name: 'firstname'},
            {data: 'lastname', name: 'lastname'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        "ajax" : {
            url : "{{ route('admin_user-datatable') }}",
            type : "POST",
            data : function(d) {
                d._token = "{{ csrf_token() }}"
            }
        }
    });

    $(document).on('click', '.delete', function() {
        var href = $(this).data('href');
        swal({
            title: "",
            text: "{{__('Are you sure? Delete this user!')}}",
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

    $(document).on('click', '.selected_data', function(){
        var group = $(this).val();
        if(group != null || group != ''){
            var admin = [];
            $('input.checkSingle:checkbox:checked').each(function () {
                admin.push($(this).val());
            });
            if(jQuery.isEmptyObject(admin)){
                swal("Please select data!");
            } else {
                swal({
                    title: "",
                    text: "Are you sure you want to Delete This Selected Data?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "OK",
                    closeOnConfirm: true
                }, function() {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url : "{{ route('admin_deletedata') }}",
                        method : 'post',
                        data : {_token : CSRF_TOKEN, group : group, admin : admin},
                        success : function(result){
                            var result = $.parseJSON(result);
                            page.ajax.reload();
                        }
                    });
                });
            }
        }
    });
});

             
</script>

@endsection