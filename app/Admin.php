<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable =['ci', 'employment'];
    public $timestamps = false;
    public function user()
     {
     return $this->morphOne('App\User', 'userable');
     }  
}
