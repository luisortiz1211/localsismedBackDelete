<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Patient;
use App\ScheduleUser;
class ScheduleDay extends JsonResource
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
            'schedule_day' => $this->id,
            'scheduleDay'=>$this->scheduleDay,
            'scheduleDayState'=>$this->scheduleDayState,
            'user_id' => $this->user_id,
            'scheduleTime' => $this->scheduleTime,
            'schedule_id' => $this->schedule_id,
            'created_at' => $this->created_at,
            'userAssigned'=>$this->userAssigned,
            'patient_id'=>$this->patient_id,
        ];
    }
}
