<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ScheduleDay extends Model
{
    protected $fillable = [
        'scheduleDay',
        'scheduleTime',
        'schedule_id',
        'userAssigned',
        'scheduleDayState',
        'patient_id'
    ];
    //Relacion una cita agendada le pertenece a un paciente
    public function patient()
    {
        return $this->hasOne('App\Patient');
    }
    //una cita le pertenece a un usuario
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scheduleUser(){
        return $this->belongsTo('App\ScheduleUser');
    }

    public function physicalExam()
    {
        return $this->hasOne('App\PhysicalExam');
    }

    // Al crear la cita se agrega el id del usuario activo
    public static function boot()
    {
        parent::boot();
        static::creating(function ($schedule_days) {
            $schedule_days->user_id = Auth::id();
        });
    }
}
