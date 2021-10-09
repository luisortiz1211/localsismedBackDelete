<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalHistory extends Model
{
    protected $fillable = [
        'nameCondition',
        'yearCondition',
        'commentCondition',
        'patient_id'
    ];
    //Relacion un antecendente personal le pertenece a un paciente
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
