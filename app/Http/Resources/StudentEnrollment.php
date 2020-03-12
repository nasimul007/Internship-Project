<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentEnrollment extends JsonResource
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
            'student_id' => $this->student_id,
            'name' => $this->name,
            'credits_left' => $this->credits_left,
            'subjects_left' => $this->subjects_left,
            'batch_id' => $this->batch_id,
            'internship_status' => $this->internship_status,
            'registration_status' => $this->registration_status,
            'registration_date' => $this->registration_date,
            'enrollment_date' => $this->enrollment_date,
            'semester_id' => $this->semester_id,
            'token_no' => $this->token_no
        ];
    }
}
