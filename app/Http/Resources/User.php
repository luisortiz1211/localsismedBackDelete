<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    protected $token;
    public function __construct($resource , $token = null)
    {
        parent::__construct($resource);
        $this->token = $token;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lastName'=>$this->lastName,
            'email' => $this->email,
            //'role'=>$this->merge($this->userable),
            'availableStatus'=>$this->availableStatus,
            'roleUser'=>$this->roleUser,
            'ci'=>$this->merge($this->userable->ci),
            'employment'=>$this->merge($this->userable->employment),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            //'scheduleUser' => '/api/scheduleUser/' . $this->id,
            //'scheduleDay' => '/api/scheduleDay/' . $this->id,
            //'token'=>$this->when($this->token, $this->token),
        ];
    }
}
