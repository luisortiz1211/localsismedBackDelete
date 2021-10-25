<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Patient;

class ImageRecipie extends JsonResource
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
            'patient_id' => $this->patient_id,
            'imageRecipie_id'=>$this->id,
            'user_id' => $this->user_id,
            'exploration_id' => $this->exploration_id,
            'codimage' => $this->codimage,
            'nameImageRecipie' => $this->nameImageRecipie,
            'created_at'=>$this->created_at,
            'exploration_id'=>$this->exploration_id,

        ];
    }
}
