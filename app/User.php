<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable implements JWTSubject
{
    const ROLE_SUPERADMIN='ROLE_SUPERADMIN';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_MEDIC = 'ROLE_MEDIC';
    const ROLE_ASSISTENT = 'ROLE_ASSISTENT';

    private const ROLES_HIERARCHY = [
     self::ROLE_SUPERADMIN => [self::ROLE_MEDIC, self::ROLE_ASSISTENT, self::ROLE_ADMIN], 
     self::ROLE_ADMIN => [self::ROLE_MEDIC, self::ROLE_ASSISTENT],
     self::ROLE_MEDIC => [self::ROLE_ASSISTENT],
     self::ROLE_ASSISTENT => []
    ];


    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $table = 'users';
    // Campos protegidos para tabla User
    protected $fillable = [
        'name',
        'lastName',
        'email',
        'password',
        'availableStatus',
        'roleUser',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    // Relaciones uno usuario tiene mucho horarios
    public function scheduleUser()
    {
        return $this->hasMany('App\ScheduleUser');
    }
    //Relacion el usuario puede tener muchos agendamientos
    public function scheduleDay()
    {
        return $this->hasMany('App\ScheduleDay');
    }
    //Relacion un usuario registra muchos pacientes
    public function patients()
    {
        return $this->hasMany('App\Patient');
    }
    //Raleacion un usuario registra muchos examenes fisicos
    public function physicalExams()
    {
        return $this->hasMany('App\PhysicalExam');
    }
    //Relacion un usuario registra muchos exploraciones
    public function explorationPatient()
    {
        return $this->hasMany('App\ExplorationPatient');
    }
    //Relacion un usuario registrar recetar muchas medicinas
    public function drugsRecipie()
    {
        return $this->hasMany('App\DrugsRecipie');
    }
    //Relacion un usuario puede registrar muchos pedidos de imagen
    public function imageRecipie()
    {
        return $this->hasMany('App\ImageRecipie');
    }
    public function isGranted($roleUser)
    {
     return $roleUser === $this->roleUser || in_array($roleUser,self::ROLES_HIERARCHY[$this->roleUser]);
    }
    public function userable()
    {
    return $this->morphTo();
    }
}
