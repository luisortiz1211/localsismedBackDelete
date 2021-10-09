<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmergencyContact;
use App\PhysicalExam;
use App\Patient;
use App\Http\Resources\EmergencyContact as EmergencyContactResource;
use App\Http\Resources\EmergencyContactCollection;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\Validator;

class EmergencyContactController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attribute es obligatorio',
    ];
    public static $rules = [
        'nameContact' => 'required|string',
        'movil' => 'required',
        'landline' => 'required',
        'relationShip' => 'required|string',
        'bloodType' => 'required|string',
    ];
    public static $repulses = [
        'nameContact' => 'string',
        'movil' => 'numeric',
        'landline' => 'numeric',
        'relationShip' => 'string',
        'bloodType' => 'string',
    ];
    //mostrar los contactod de todos los pacientes
    public function index()
    {
        //$this->authorize('view',EmergencyContact::class);
        return new EmergencyContactCollection(EmergencyContact::paginate(10));
    }
    // mostrar contactos de emergencia de un paciente
    public function show( EmergencyContact $emergencyContact)
    {
       //$this->authorize('view',$emergencyContact);
        return response()->json(
            new EmergencyContactResource($emergencyContact),
            200
        );
    }
    // mostrar un contacto de emergencia
    public function showOneEmergencyContact(Patient $patient,EmergencyContact $emergencyContact)
    {
       //$this->authorize('view',$emergencyContact);
        $emergencyContact= $patient->emergencyContact()->where('id',$emergencyContact->id)->firstOrFail();
        return response()->json($emergencyContact,200);
    }
    //crear un contacto de emergencia
    public function store(Request $request, EmergencyContact $emergencyContact)
    {
        //$this->authorize('create',EmergencyContact::class);
        $request->validate(self::$rules, self::$messages);
        $emergencyContact = new EmergencyContact($request->all());
        $emergencyContact->save();
        return response()->json(new EmergencyContactResource($emergencyContact), 201);
    }
    //actualizar un contacto de emergencia
    public function update(Request $request, Patient $patient, EmergencyContact $emergencyContact)
    {
        //$this->authorize('update', $emergencyContact);
        $request->validate(self::$repulses, self::$messages);
        $emergencyContact->update($request->all());
        return response()->json($emergencyContact, 200);
    }
    //borrar contacto de emergencia
    public function delete(Patient $patient, EmergencyContact $emergencyContact)
    {
        //$this->authorize('delete',$emergencyContact);
        $emergencyContact->delete();
        return response()->json(null, 204);
    }
}
