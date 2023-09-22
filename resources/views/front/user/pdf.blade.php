<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Order Detail</title>
    <style type="text/css">

    ::selection { background-color: #E13300; color: white; }
    ::-moz-selection { background-color: #E13300; color: white; }

    body {
        background-color: #fff;
        margin: 40px;
        /*font: 13px/20px normal Helvetica, Arial, sans-serif;*/
        font-family: Arial, sans-serif;
        color: black;
    }

    #body {
        margin: 0 15px 0 15px;
    }
    @page {
        header: page-header;
        footer: page-footer;
    }
    .border,
      .border > th,
      .border > td {
        padding: 10px;
        border: 1px solid black;
        border-collapse: collapse;
        line-height: 25px;
        text-align: center;
        font-size: 14px;
      }
      .text-muted{
          color: #666363;
      }
      .address{
        margin-bottom:12px;
        background: #dddddd;
      }
      .col-md-6{
        margin-left:10px;
        text-align: left;
      }
      .col-md-5{
        margin-right:10px;
        text-align: right;
      }
      table {
            caption-side: bottom;
            border-collapse: collapse;
            align:center;
        }
        table thead tr {
            background-color: #164498;
            color: #ffffff;
            text-align: left;
        }
        table thead tr th {
            padding: 12px 15px;
        }
        tbody tr {
            border-bottom: 1px solid #dddddd;
            border-color:#dddddd;
        }
        tbody tr td {
            padding: 12px 15px;
        }
        .detail{
            text-align: right;
        }
    </style>
</head>
<body>
@if($orders->count())
    @foreach($orders as $order)
        <div class="address">
            <div class="row">
                <div class="col-md-6">
                    {{$order->name}},<br/>
                    {{$order->email}},<br/>
                    {{$order->phone}},<br/>
                    {{$order->address}},<br/>
                    {{$order->city}},<br/>
                    {{$order->zip}},<br/>
                </div>
                <div class="col-md-5">
                    Invoice
                    {{isset($order->invoice_no) ? '#'.$order->invoice_no : ''}}
                </div>
            </div>
        </div>
<div>
    <table style="width:70">
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Gst(%)</th>
            </tr>
        </thead>
        <tbody>
        @php($detail = isset($order->detail) && $order->detail->count() ? $order->detail : array())
        @if($detail)
            <tr>
                <td>  @php($is_service_in_order = 0)
                    @foreach($detail as $record)
                        @if($record->service_id)
                            @php($is_service_in_order = $order->id)
                            @php($service_category = isset($record->packageDetail->packageDetail->categoryDetail->title) ? $record->packageDetail->packageDetail->categoryDetail->title : NULL)
                            @php($service = isset($record->packageDetail->packageDetail->title) ? $record->packageDetail->packageDetail->title : NULL)
                            @php($brand = isset($record->packageDetail->brandDetail->title) ? $record->packageDetail->brandDetail->title : NULL)
                            @php($model = isset($record->packageDetail->modelDetail->title) ? $record->packageDetail->modelDetail->title : NULL)
                            @php($fuel = isset($record->packageDetail->fuelTypeDetail->title) ? $record->packageDetail->fuelTypeDetail->title : NULL)
                            {{$service_category}}<br/>
                            {{$service}}<br/>
                            <small class="font-small">
                                {{$brand.' - '.$model.' - '.$fuel}}<br/>
                            </small>
                            <small class="font-small text-danger">
                                <b>Pick Up Details : 
                                    {{isset($order->slotDetail->slot_date) && $order->slotDetail->slot_date ? date('d/m/Y', strtotime($order->slotDetail->slot_date)) : '' }}
                                    {{isset($order->slotDetail->id) ? " ".$order->slotDetail->pick_up_time1.'-'.$order->slotDetail->pick_up_time2 : ''}}
                                    {{isset($order->slotDetail->time_type) && $order->slotDetail->time_type == '1' ? " PM" : ' AM'}}
                                    {{isset($order->slotDetail->time_takes) && $order->slotDetail->time_takes ? ', time takes '.$order->slotDetail->time_takes. ' hrs' : ''}}
                                </b>
                            </small>
                            <hr/>
                        @endif
                        @if($record->product_id)
                            {{isset($record->productDetail->name) ? $record->productDetail->name : NULL}}<br/>
                            <hr/>
                        @endif
                    @endforeach
                </td>
                <td>{{isset($record->qty) ? $record->qty : ''}}</td>
                <td>{{isset($record->price) ? $record->price : ''}}</td>
                <td>{{isset($order->service_gst_rate) ? $order->service_gst_rate : ''}}</td>
            </tr>
        @endif
        </tbody>
    </table>
    <div class="detail">
        Sub Total:<br/>
        Tax:{{isset($order->service_gst_rate) ? $order->service_gst_rate : ''}}<br/>
        Total:₹{{formatNumber($order->total)}}<br/>
    </div>
</div>
@endforeach
@endif
</body>
</html>
