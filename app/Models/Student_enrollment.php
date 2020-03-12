<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student_enrollment extends Model
{
    protected $primaryKey = 'student_id';
	protected $table = 'student_enrollments';
    public $timestamps = false;
    public $incrementing = false;
}
