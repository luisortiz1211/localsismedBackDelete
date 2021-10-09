<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DrugAllergies extends Model
{
    protected $fillable = ['drugName', 'drugSymptom', 'drugRemark','patient_id'];
    //Relacion un alergia a medicamento le pertenece a un paciente
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
