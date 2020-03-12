<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Teacher extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'teacher_id' => $this->teacher_id,
            'access_status' => $this->access_status,
            'email' => $this->email,
            'mobileNo' => $this->mobileNo,
            'TA_vacancy' => $this->TA_vacancy,
        ];

        //'name','teacher_id','access_status','email','mobileNo'
    }
}
