<?php

namespace App\Http\Resources;
use App\Patient;
use Illuminate\Http\Resources\Json\JsonResource;
use Appp\Htttp\Resources\DrugAllergiews;
class DrugAllergies extends JsonResource
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
            'patient_id'=>$this ->id,
            'drugAllergies_id'=>$this ->id,
            'drugName' => $this->drugName,
            'drugSymptom' => $this->drugSymptom,
            'drugRemark' => $this->drugRemark,
            'created_at'=>$this->created_at,
        ];
    }
}
