<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $primaryKey = 'batch_id';
    public $timestamps = false;

    protected $fillable = [
        'batch_id', 'teacher_id'
    ];
}
