<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class PhysicalExam extends Model
{
    protected $fillable = [
        'date',
        'heartRate',
        'bloodPleasure',
        'weight',
        'height',
        'idealWeight',
        'temp',
        'tobacco',
        'alcohol',
        'drugs',
        'apetiteChanges',
        'dreamChanges',
        'currentCondition',
        'comment',
        'currentDrug',
        'patient_id',
        'schedule_day',
            ];
    //Relacion un Examen fisico tiene una exploracion
    public function explorationPatient()
    {
        return $this->hasOne('App\ExplorationPatient','physicalExam_id');
    }
    //Relacion un examen fisico le pertenece a un paciente
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function scheduleDay()
    {
        return $this->belongsTo('App\ScheduleDay');
    }

    // Al registrar el examen fisico se agrega el id del usuario activo
    public static function boot()
    {
        parent::boot();
        static::creating(function ($physical_exams) {
            $physical_exams->user_id = Auth::id();
        });
    }
}
