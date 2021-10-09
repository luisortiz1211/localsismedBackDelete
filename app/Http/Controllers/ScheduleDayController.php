<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ScheduleDay;
use App\User;
use App\Patient;

use App\Http\Resources\ScheduleDay as ScheduleDayResource;
use App\Http\Resources\ScheduleDayCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class ScheduleDayController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attribute es obligatorio ',
    ];
    public static $rules = [
        'scheduleDay' => 'string',
        'scheduleTime ' => 'string',
        //'availableStatus' => ' boolean',
    ];
    public static $repulses = [
        'scheduleDay' => 'string',
        'scheduleTime ' => 'string',
        //'availableStatus' => ' boolean',
    ];
    // muestra todas las agendas del dia
    public function index()
    {
        return new ScheduleDayCollection(ScheduleDay::paginate(10));
    }
    // muestra las agendas de un usuario
    public function show(ScheduleDay $scheduleDay)
    {
        /* return response()->json(
            ScheduleDayResource::collection($scheduleDay),
            200
        ); */
        $this->authorize('view', $scheduleDay);
        return response()->json(new ScheduleDayResource($scheduleDay), 200);
   
    }
    // mostrar agentamientos para un usuario en especifico
    public function showScheduleDayUser(User $user, ScheduleDay $scheduleDay)
    {
        User::class;
        $user = $scheduleDay->where('userAssigned', $user['id'])->get();
        return response()->json(new ScheduleDayCollection($user), 200);
    }
    public function showScheduleDayPatient(Patient $patient, ScheduleDay $scheduleDay)
    {
        Patient::class;
        $patient = $scheduleDay->where('patient_id', $patient['id'])->get();
        return response()->json(new ScheduleDayCollection($patient), 200);
    }


    // horarios de un medico--------------------------------------------
    public function showScheduleDay(User $user, ScheduleDay $scheduleDay)
    {
        $scheduleDay = $user->scheduleDay()->where('id', $scheduleDay->id)->firstOrFail();
        return response()->json($scheduleDay, 200);
    }
    // citas activas de un medico
    public function filterDaySchedule($day)
    {
        $user_id = DB::table('schedule_days')
            ->where('scheduleDay', 'like', '%' . $day . '%')
            ->get();
        return response()->json(new ScheduledayCollection($user_id), 201);
    }
    // buscar agendamiento de citas pendientes
    public function findStatePendiente()
    {
        $scheduleDayState = array();
        $scheduleDays = ScheduleDay::all();
        foreach ($scheduleDays as $schedule) {
            if ('pendiente' == $schedule->scheduleDayState) {
                $scheduleDayState[] = $schedule;
            }
        }
        return  response()->json(new ScheduleDayCollection($scheduleDayState), 200);
    }
    // buscar agendamiento de citas agendadas
    public function findStateAtendido()
    {
        $scheduleDayState = array();
        $scheduleDays = ScheduleDay::all();
        foreach ($scheduleDays as $schedule) {
            if ('atendido' == $schedule->scheduleDayState) {
                $scheduleDayState[] = $schedule;
            }
        }
        return  response()->json(new ScheduleDayCollection($scheduleDayState), 200);
    }
    // buscar agendamiento de citas cancelados
    public function findStateCancelado()
    {
        $scheduleDayState = array();
        $scheduleDays = ScheduleDay::all();
        foreach ($scheduleDays as $schedule) {
            if ('cancelado' == $schedule->scheduleDayState) {
                $scheduleDayState[] = $schedule;
            }
        }
        return  response()->json(new ScheduleDayCollection($scheduleDayState), 200);
    }
    // crear una agenda
    public function store(Request $request, ScheduleDay $scheduleDay)
    {
        $request->validate(self::$rules, self::$messages);
        $scheduleDay = new ScheduleDay($request->all());
        $scheduleDay->save();
        return response()->json(new ScheduleDayResource($scheduleDay), 201);
    }
    //modificar una agenda
    public function update(Request $request, User $user, ScheduleDay $scheduleDay)
    {
        $request->validate(self::$repulses, self::$messages);
        $scheduleDay->update($request->all());
        return response()->json($scheduleDay, 200);
    }
    //Borrar agenda
    public function delete(User $user, ScheduleDay $scheduleDay)
    {
        $scheduleDay->delete();
        return response()->json(null, 204);
    }
}
