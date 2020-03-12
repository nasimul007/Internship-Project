<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student_upload extends Model
{
    protected $primaryKey = 'student_id';
	protected $table = 'student_uploads';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'student_id','cv_title','cv_path'
    ];
}
