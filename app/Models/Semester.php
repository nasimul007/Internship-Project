<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $primaryKey = 'semester_id';
    public $timestamps = false;
    protected $fillable = [
        'semester_name'
    ];
}
