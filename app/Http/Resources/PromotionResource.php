<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PromotionResource extends JsonResource
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
            'examens' => ExamensResource::collection($this->examens),
            'users' => UsersResource::collection($this->users) 
        ];
    }
}
