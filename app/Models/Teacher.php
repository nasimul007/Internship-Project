<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name','teacher_id','access_status','email','mobileNo','TA_vacancy'
    ];
}
