<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleUser extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'schedule_id' => $this->id,
            'userDay' => $this->userDay,
            'startTime' => $this->startTime,
            'finishTime' => $this->finishTime,
            'availableStatus'=>$this->availableStatus,
            'user_id' => $this->user_id,
        ];
    }
}
