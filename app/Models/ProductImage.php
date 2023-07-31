<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $table = 'product_images';
    protected $primaryKey = 'product_id';
    protected $fillable = ['image', 'alt_text', 'title', 'is_primary'];
}
