<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Student extends JsonResource
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
            'student_id' => $this->student_id,
            'name' => $this->name,
            'department' => $this->department,
            'email' => $this->email,
            'credits_left' => $this->credits_left,
            'mobileNo' => $this->mobileNo,
            'credits_left' => $this->credits_left,
            'subjects_left' => $this->subjects_left,
            'batch_id' => $this->batch_id,
            'applied_TA' => $this->applied_TA,
            'internship_status' => $this->internship_status,
            'registration_status' => $this->registration_status,
            'registration_date' => $this->registration_date,
            'enrollment_date' => $this->enrollment_date,
            'semester_id' => $this->semester_id,
            'token_no' => $this->token_no
        ];
    }
}
