<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyHistory extends Model
{
    protected $fillable = [
        'nameCondition',
        'yearCondition',
        'commentCondition',
        'patient_id'
    ];
    //Relacion un antecedente familiar le pertenece a un paciente
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
