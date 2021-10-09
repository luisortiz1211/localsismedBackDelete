<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medic extends Model
{
    protected $fillable = ['ci', 'employment'];
    public $timestamps = false;
    public function user()
    {
    return $this->morphOne('App\User', 'userable');
    }
}
