<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fields = ['user_id', 'is_guest_chekout', 'payment_type', 'name', 'email', 'phone', 'address', 'zip', 'city', 'total', 'order_date'];

    public function userDetail()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
