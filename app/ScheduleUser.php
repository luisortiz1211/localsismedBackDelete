<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ScheduleUser extends Model
{
    protected $fillable = ['userDay', 'startTime', 'finishTime','availableStatus','user_id'];

    //Relacion un horario le pertenece a un usuario
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    // Relacion un horario tiene un agendamiento

    public function scheduleDay(){
        return $this->hasOne('App\ScheduleDay');
    }
    // Al crear horario se agrega el id del usuario activo
    /*public static function boot()
    {
        parent::boot();
        static::creating(function ($schedule_user) {
            $schedule_user->user_id = Auth::id();
        });
    }*/
}
