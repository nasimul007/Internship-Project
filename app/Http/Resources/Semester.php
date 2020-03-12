<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Semester extends JsonResource
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
            'semester_id' => $this->semester_id,
            'semester_name' => $this->semester_name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'created_date' => $this->created_date,
            'status' => $this->status
        ];
    }
}
