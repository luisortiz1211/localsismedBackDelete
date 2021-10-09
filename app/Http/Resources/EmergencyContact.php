<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmergencyContact extends JsonResource
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
            'id'=>$this->id,
            'emergencyContact_id' => $this ->id,
            'patient_id' => $this->patient_id,
            'nameContact' => $this->nameContact,
            'movil' => $this->movil,
            'landline' => $this->landline,
            'relationShip' => $this->relationShip,
            'bloodType' => $this->bloodType,
        ];
    }
}
