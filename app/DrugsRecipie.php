<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DrugsRecipie extends Model
{
    protected $fillable = ['coddrug', 'nameDrugRecipie','exploration_id','patient_id'];
    //Relacion una receta de medicamentos se registra por un usuario
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    //Relacion un medicamento recetado le pertenece a una exploracio
    public function explorationPatient()
    {
        return $this->belongsTo('App\ExplorationPatient');
    }
    //Relacion un medicamento recetado le pertenece a un paciente
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
    
    // Al registrar la receta de medicamentos del paciente se agrega el id del usuario activo
    public static function boot()
    {
        parent::boot();
        static::creating(function ($drugs_recipies) {
            $drugs_recipies->user_id = Auth::id();
        });
    }
}
