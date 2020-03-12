<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $primaryKey = 'notice_id';
    public $timestamps = false;
    protected $fillable = [
        'subject','content','teacher_id'
    ];
}
