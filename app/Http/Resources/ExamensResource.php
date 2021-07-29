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
        $activities = ActivitiesResource::collection($this->activities);
        return [
            'id' => $this->id,
            'start' => $this->beginAt,
            'end' => $this->endAt,
            'title' => $this->name,
            'description' => $activities
        ];
    }
}
