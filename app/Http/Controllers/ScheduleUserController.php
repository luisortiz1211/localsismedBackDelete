<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ScheduleUser;
use App\Http\Resources\ScheduleUser as ScheduleUserResource;
use App\Http\Resources\ScheduleUserCollection;

use App\User;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;

class ScheduleUserController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attribute es obligatorio ',
        'unique'=>'El campo :attribute es obligatorio'
    ];
    public static $rules = [
        'userDay'=>'required|string',
        'startTime'=>'required',
        'finishTime'=>'required',
        'availableStatus'=> 'required'
    ];
    public static $repulses = [
        'userDay'=>'string',
        'startTime'=>'string',
        'finishTime'=>'string',
        'availableStatus'=> 'required'
    
    ];
    //mostrar todos los horarios de usuarios
    public function index()
    {
       // $this->authorize('view', ScheduleUser::class);
        return response()->json(
            ScheduleUserResource::collection(ScheduleUser::all()),
            200
        );
    }
    // mostrar los horarios de un usuario en especifico
    public function show(ScheduleUser $scheduleUser)
    {
        $this->authorize('view', $scheduleUser);
        return response()->json(new ScheduleUserResource($scheduleUser), 200);
    }

    //mostrar horarios de usuario
    public function showScheduleUser(User $user, ScheduleUser $scheduleUser)
    {
       $this->authorize('view', $scheduleUser);
        User::class;
        $user = $scheduleUser->where('user_id', $user['id'])->get();
        return response()->json(new ScheduleUserCollection($user), 200);
    }
    //Crear un horario usuario
    public function store(Request $request, ScheduleUser $scheduleUser)
    {
        //$this->authorize('create', ScheduleUser::class);
        $request->validate(self::$rules, self::$messages);
        $scheduleUser = new ScheduleUser($request->all());
        $scheduleUser->save();
        //return response()->json($scheduleUser, 201);
        return response()->json(new ScheduleUserResource($scheduleUser), 201);
    
    }
    //Actualizar un usuario
    public function update(Request $request, ScheduleUser $scheduleUser)
    {
        $this->authorize('update', $scheduleUser);
        $request->validate(self::$repulses, self::$messages);
        $scheduleUser->update($request->all());
        return response()->json($scheduleUser, 200);
    }
    public function delete(ScheduleUser $scheduleUser)
    {
        $this->authorize('delete', $scheduleUser);
        $scheduleUser->delete();
        return response()->json(null, 204);
    }
}
