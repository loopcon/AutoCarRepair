<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $table = 'service_categories';
    protected $fillable = ['slug', 'title', 'image','image_1', 'description', 'meta_title', 'meta_keywords', 'meta_description', 'is_archive', 'order_by', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'];
}
