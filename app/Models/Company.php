<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $primaryKey = 'company_id';
    public $timestamps = false;
    protected $fillable = [
        'company_name','company_type','company_address','company_website','company_contact'
    ];
}
