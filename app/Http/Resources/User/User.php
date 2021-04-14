<?php

namespace App\Http\Resources\User;

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
            'id' => $this->id,
            'firstname' => $this->firstname,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'phone_number' => $this->phone_number,
            'firstname' => $this->firstname,
            'firstname' => $this->firstname,
            'created_at' => $this->created_at,
        ];
    }
}
