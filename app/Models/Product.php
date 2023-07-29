<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['slug', 'shop_category_id', 'name', 'sku', 'description', 'specification', 'price', 'amazon_link', 'flipcart_link', 'is_archive', 'status', 'created_by', 'updated_by'];

    public function shopCategoryDetail(){
        return $this->belongsTo(ShopCategory::class, 'shop_category_id');
    }
}
