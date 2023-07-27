<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBrand extends Model
{
    use HasFactory;
    protected $table = 'car_brands';
    protected $fillable = ['slug', 'title', 'image', 'is_archive', 'status', 'created_by', 'updated_by'];
}
