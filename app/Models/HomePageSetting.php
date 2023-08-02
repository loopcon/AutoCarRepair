<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePageSetting extends Model
{
    use HasFactory;
    protected $table = 'home_page_setting';

    protected $fillable = ['id','section1_title1', 'section1_title2', 'section1_image', 'section1_description', 'footer_description','meta_title','meta_keywords','meta_description','created_by', 'updated_by'];
}
