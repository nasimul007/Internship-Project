<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $primaryKey = 'student_id';
    public $timestamps = false;
    public $incrementing = false;
}
