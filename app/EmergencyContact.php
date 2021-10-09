<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
    protected $fillable = [
        'nameContact',
        'movil',
        'landline',
        'relationShip',
        'bloodType',
        'patient_id'
    ];
    //Relacion un contacto de emergencia le pertenece a un paciente
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
