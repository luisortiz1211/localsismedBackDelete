<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PersonalHistory;
use App\Patient;
use App\Http\Resources\PersonalHistory as PersonalHistoryResource;
use App\Http\Resources\PersonalHistoryCollection;

class PersonalHistoryController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attribute es obligatorio ',
    ];
    public static $rules = [
        'nameCondition' => 'required|string',
    'yearCondition' => 'required|string',
    'commentCondition'=>'required|string'];
       
    public static $repulses = [
        'nameCondition' => 'string',
        'yearCondition' => 'string',
        'commentCondition'=>'string'
    ];
    // muestra los antecedentes personales de los pacientes
    public function index()
    {
        //$this->authorize('view',PersonalHistory::class)
        return response()->json(
            PersonalHistoryResource::collection(PersonalHistory::all()),
            200
        );
    }
    // muestra los antecedentes personales de un paciente
    public function show(PersonalHistory $personalHistory)
    {
       // $this->authorize('view',$personalHistory);
        return response()->json(
            new PersonalHistoryResource($personalHistory),
            200
        );
    }
    //mostrar un personal history del paciente
    public function showOnePersonalHistory(Patient $patient,PersonalHistory $personalHistory)
    {
       //$this->authorize('view',$emergencyContact);
        $personalHistory= $patient->personalHistory()->where('id',$personalHistory->id)->firstOrFail();
        return response()->json($personalHistory,200);
    }
    //muestra las enfermedades de un paciente
    public function store(Request $request, PersonalHistory $personalHistory)
    {
       // $this->authorize('create',PersonalHistory::class);
        $request->validate(self::$rules, self::$messages);
        $personalHistory = new PersonalHistory($request->all());
        $personalHistory->save();
        //$personalHistory = PersonalHistory::create($request->all());
        return response()->json(new PersonalHistoryResource($personalHistory), 201);
    }
    // actualizar enfermedades del paciente
    public function update(Request $request, Patient $patient,PersonalHistory $personalHistory)
    {
       // $this->authorize('update', $personalHistory);
        $request->validate(self::$repulses, self::$messages);
        $personalHistory->update($request->all());
        return response()->json($personalHistory, 200);
    }
    //borrar enfermedades del paciente
    public function delete(Patient $patient, PersonalHistory $personalHistory)
    {
       // $this->authorize('delete',$cheduleDay) ;
        $personalHistory->delete();
        return response()->json(null, 204);
    }
}
