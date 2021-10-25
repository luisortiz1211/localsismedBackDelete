<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Patient;
use App\PhysicalExam;

class DrugsRecipie extends JsonResource
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
            'patient_id'=>$this->patient_id,
            'drugsRecipie_id' =>$this ->id,
            'physicalExam_id' => $this->physicalExam_id,
            'coddrug' => $this->coddrug,
            'nameDrugRecipie' => $this->nameDrugRecipie,
            'user_id' => $this->user_id,
            'created_at'=>$this->created_at,
            'exploration_id'=>$this->exploration_id,
        ];
    }
}
