<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Notice extends JsonResource
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
            'notice_id' => $this->notice_id,
            'subject' => $this->subject,
            'content' => $this->content,
            'teacher_id' => $this->teacher_id,
            'receiver' => $this->receiver,
            'is_read' => $this->is_read,
            'date' => $this->date,
        ];
    }
}
