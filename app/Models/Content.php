<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    protected $table = 'content';
    protected $fillable = ['section1_title1', 'section1_title2', 'section1_image', 'section1_description',  'created_by', 'updated_by'];
}
