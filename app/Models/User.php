<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = ['id','firstname','lastname','email','password','password','image','address','city','state','country','zipcode','status','is_archive','created_by','created_at','updated_by','updated_at'];
}
