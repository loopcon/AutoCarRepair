<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopCategory extends Model
{
    use HasFactory;

    protected $table = 'shop_categories';
    protected $fillable = ['id','slug', 'name', 'is_archive', 'status', 'created_by', 'updated_by'];
}
