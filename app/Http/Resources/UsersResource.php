<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->promotion) {
            return [
                'id' => $this->id,
                'lastName' => $this->lastName,
                'firstName' => $this->firstName,
                'promotion' => $this->promotion->name
            ];
        }
        return [
            'id' => $this->id,
            'lastName' => $this->lastName,
            'firstName' => $this->firstName
        ];
    }
}
