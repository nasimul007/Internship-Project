<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Batch extends JsonResource
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
            'batch_id' => $this->batch_id,
            'approved' => $this->approved,
            'date' => $this->date,
            'teacher_id' => $this->teacher_id,
            'semester_id' => $this->semester_id,
            'semester_name' => $this->semester_name,
            'teacher_name' => $this->name,
            'req_to_complete' => $this->req_to_complete,
            'grade_report_title' => $this->grade_report_title,
        ];
    }
}
