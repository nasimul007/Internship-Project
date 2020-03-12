<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'sl' => $this->sl,
            'userid' => $this->userid,
            'password' => $this->password,
            'email' => $this->email,
            'type' => $this->type
        ];
    }
}
