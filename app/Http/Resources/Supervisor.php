<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Supervisor extends JsonResource
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
            'supervisor_id' => $this->supervisor_id,
            'supervisor_name' => $this->supervisor_name,
            'supervisor_number' => $this->supervisor_number,
            'supervisor_email' => $this->supervisor_email,
            'supervisor_designation' => $this->supervisor_designation,
            'student_id' => $this->student_id,
            'company_name' => $this->company_name,
            'company_type' => $this->company_type,
            'company_contact' => $this->company_contact,
            'company_address' => $this->company_address,
            'company_website' => $this->company_website,
            'assigned_date' => $this->assigned_date
        ];

        //'supervisor_name','supervisor_number','supervisor_email','supervisor_designation','student_id',
        //'company_name','company_type','company_address','company_website'
    }
}
