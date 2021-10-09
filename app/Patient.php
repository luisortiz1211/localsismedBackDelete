<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Patient extends Model
{
    protected $fillable = [
        'ci',
        'name',
        'lastName',
        'sex',
        'civilStatus',
        'birthay',
        'employment',
        'email',
        'movil',
        'landline',
        'address',
        'nationality',
        'city',
        'parish',
    ];
    //Relacion una cita agendada le pertenece a un paciente
    public function scheduleDay()
    {
        return $this->belongsTo('App\ScheduleDay');
    }
    //Relacion un paciente tiene mucho contactos de emergencia
    public function emergencyContact()
    {
        return $this->hasMany('App\EmergencyContact');
    }
    //Relacion un paciente tiene muchos medicamentos alergicos
    public function drugAllergie()
    {
        return $this->hasMany('App\DrugAllergies');
    }
    //Relacion un paciente tiene muchos antecedentes familiares
    public function familyHistory()
    {
        return $this->hasMany('App\FamilyHistory');
    }
    //Relacion un paciente tiene muchos examenes fisicos
    public function physicalExam()
    {
        return $this->hasMany('App\PhysicalExam');
    }
    //Relacion un paciente tiene muchas exploraciones
    public function explorationPatient()
    {
        return $this->hasMany('App\ExplorationPatient');
    }
    //Relacion un paciente tiene muchas imagenes
    public function imageRecipie()
    {
        return $this->hasMany('App\imageRecipie');
    }
    //Relacion un paciente tiene muchas medicamentos
    public function drugsRecipie()
    {
        return $this->hasMany('App\drugsRecipie');
    }
    // Relacion un paciente tiene registro personal
    public function personalHistory()
    {
        return $this->hasMany('App\PersonalHistory');
    }
    //Relacion un paciente es registrado por un usuario
    public function user()
    {
        return $this->belongsTo('App\User');
    }
        // Al registrar un paciente se agrega el id del usuario activo
    public static function boot()
    {
        parent::boot();
        static::creating(function ($patients) {
            $patients->user_id = Auth::id();
        });
    }
}
