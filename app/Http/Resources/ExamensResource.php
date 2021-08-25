<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExamensResource extends JsonResource
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
            'start' =>  str_replace(' ','T',$this->beginAt),
            'end' => str_replace(' ','T',$this->endAt),
            'title' => $this->name
            /* 'description' => ActivitiesResource::collection($this->activities) */
        ];
    }
}
