<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ImageRecipie extends Model
{
    protected $fillable = ['codimage','nameImageRecipie','exploration_id','patient_id'];
    //Relacion un pedido de imagen se registra por un usuario
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    //Relacion un examen de imagen le pertenece a una exploracio
    public function explorationPatient()
    {
        return $this->belongsTo('App\ExplorationPatient');
    }
    //Relacion un examen de imagen le pertenece aun paciente
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
    // Al registrar el examen de imagen del paciente se agrega el id del usuario activo
    public static function boot()
    {
        parent::boot();
        static::creating(function ($image_recipies) {
            $image_recipies->user_id = Auth::id();
        });
    }
}
