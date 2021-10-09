<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ExplorationPatient extends Model
{
    protected $fillable = [
        'physicalExam_id',
        'patient_id',
        'headExplo',
        'chestExplo',
        'extremitiesExplo',
        'neckExplo',
        'stomachExplo',
        'genitalsExplo',
        'forecastExplo',
        'diagnosisExplo',
        'treatmentExplo',
        'commentExplo',
    ];

    //Relacion una exploracion_paciente tiene  muchas drugs_recipies
    public function drugsRecipie()
    {
        return $this->hasMany('App\DrugsRecipie','exploration_id');
    }
    //Relacion una exploration_pacient tiene muchas pedidos de imagen
    public function imageRecipie()
    {
        return $this->hasMany('App\ImageRecipie','exploration_id');
    }
    //Relacion una exploracion del paciente le pertenece a un examen fisico
    public function physicalExam()
    {
        return $this->belongsTo('App\PhysicalExam');
    }
    //Relacion una exploracion paciente le pertenece a un paciente
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
    

    //Relacion un exploracion paciente es registrada por un usuario
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    // Al registrar la exploracion del paciente se agrega el id del usuario activo
    public static function boot()
    {
        parent::boot();
        static::creating(function ($exploration_patients) {
            $exploration_patients->user_id = Auth::id();
        });
    }
}
