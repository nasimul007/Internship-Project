<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    protected $primaryKey = 'supervisor_id';
    public $timestamps = false;
    protected $fillable = [
        'supervisor_name','supervisor_number','supervisor_email','supervisor_designation','student_id'
    ];
}
