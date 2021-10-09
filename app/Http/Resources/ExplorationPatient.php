<?php

namespace App\Http\Resources;
use App\Patient;
use Illuminate\Http\Resources\Json\JsonResource;

class ExplorationPatient extends JsonResource
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
            'physicalExam_id'=>$this->id,
            'explorationPatient_id' =>$this->id,
            'headExplo' => $this->headExplo,
            'chestExplo' => $this->chestExplo,
            'extremitiesExplo' => $this->extremitiesExplo,
            'neckExplo' => $this->neckExplo,
            'stomachExplo' => $this->stomachExplo,
            'genitalsExplo' => $this->genitalsExplo,
            'forecastExplo' => $this->forecastExplo,
            'diagnosisExplo' => $this->diagnosisExplo,
            'treatmentExplo' => $this->treatmentExplo,
            'commentExplo' => $this->commentExplo,
            'user_id' => $this->user_id,
            'created_at'=>$this->created_at,
        ];
    }
}
