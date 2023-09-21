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
    </style>
</head>
<body>
<div>
    <table width="100%" border="1" class="border" style="margin-top:20px;">
        <tbody>
            <tr>
                <td>#Invoice No</td>
                <td>Date</td>
                <td>Item</td>
                <td>Address</td>
                <td>Total</td>
            </tr>
            @if($orders->count())
                @foreach($orders as $order)
                @php($detail = isset($order->detail) && $order->detail->count() ? $order->detail : array())
                @if($detail)
                    <tr>
                        <td><span class="text-muted">{{isset($order->invoice_no) ? '#'.$order->invoice_no : ''}}</span></td>
                        <td><span class="text-muted">{{$order->order_date ? date('d/m/Y', strtotime($order->order_date)) : ''}}</span></td>
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
                                        {{'Price : '.$record->price.', Gst(%) : '.$order->service_gst_rate}}<br/>
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
                                    <small class="font-small">{{'Qty : '.$record->qty.', Price : '.$record->price.', Gst(%) : '.$order->product_gst_rate}}</small><br/>
                                    <hr/>
                                @endif
                            @endforeach
                        </td>
                        <td><span class="text-muted">
                                {{$order->name}},<br/>
                                {{$order->email}},<br/>
                                {{$order->phone}},<br/>
                                {{$order->address}},<br/>
                                {{$order->city}},<br/>
                                {{$order->zip}},<br/>
                            </span>
                        </td>
                        <td><span class="text-muted">₹{{formatNumber($order->total)}}</span></td>
                    </tr>
                    @endif
                @endforeach
            @endif
        </tbody>
    </table>
</div>
</body>
</html>
