<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $table = 'service_categories';
    protected $fillable = ['slug', 'title', 'image', 'is_archive', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'];
}
