<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookedSlot extends Model
{
    use HasFactory;
    protected $table = 'booked_slots';
    protected $fields = ['user_id', 'order_id', 'order_detail_id', 'slot_date', 'pick_up_slot_time', 'time_takes'];

    public function userDetail(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function orderDetails(){
        return $this->belongsTo(OrderDetails::class, 'order_detail_id');
    }
}
