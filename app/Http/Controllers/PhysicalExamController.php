<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PhysicalExam;
use App\ExplorationPatient;
use App\Patient;
use App\Http\Resources\PhysicalExam as PhysicalExamResource;
use App\Http\Resources\PhysicalExamCollection;
use App\Http\Resources\ExplorationPatient as ExplorationPatientResource;
use App\Http\Resources\ExplorationPatientCollection;

class PhysicalExamController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attribute es obligatorio ',
    ];
    public static $rules = [
        
        'heartRate'=>'numeric',
        'bloodPleasure'=>'numeric',
        'weight'=>'numeric',
        'height'=>'numeric',
        'idealWeight'=>'numeric',
        'temp'=>'numeric',
        'tobacco'=>'boolean',
        'alcohol'=>'boolean',
        'drugs'=>'boolean',
        'apetiteChanges'=>'boolean',
        'dreamChanges'=>'boolean',
        'currentCondition'=>'string',
        'comment'=>'string',
        'currentDrug'=>'string'
    ];
    public static $repulses = [
       
        'heartRate'=>'numeric',
        'bloodPleasure'=>'numeric',
        'weight'=>'numeric',
        'height'=>'numeric',
        'idealWeight'=>'numeric',
        'temp'=>'numeric',
        'tobacco'=>'boolean',
        'alcohol'=>'boolean',
        'drugs'=>'boolean',
        'apetiteChanges'=>'boolean',
        'dreamChanges'=>'boolean',
        'currentCondition'=>'string',
        'comment'=>'string',
        'currentDrug'=>'string'
    
    ];
    // muestra todos los examenes fisicos de los pacientes
    public function index()
    {
       // $this->authorize('view',PhysicalExam::class);
        return response()->json(
            PhysicalExamResource::collection(PhysicalExam::all()),
            200
        );
    }
    // muestra los examenes fisicos de un paciente
    public function show(PhysicalExam $physicalExam)
    {
       //$this->authorize('view',$physicalExam);
        return response()->json(new PhysicalExamResource($physicalExam), 200);
    }
    //mostrar el examen fisico de un paciente
    public function showOnePhysicalExam(Patient $patient, PhysicalExam $physicalExam)
    {
       //$this->authorize('view',$emergencyContact);
       $physicalExam= $patient->physicalExam()->where('id',$physicalExam->id)->firstOrFail();
        return response()->json($physicalExam,200);
    }
    // mostrar exploración de pacientes
    public function showExplorationPatients(PhysicalExam $physicalExam,ExplorationPatient $explorationPatient )
     {
       //$this->authorize('view',$physicalExam);
        PhysicalExam::class;
        $physicalExam = $explorationPatient->where('physicalExam_id', $physicalExam['id'])->get();
        return response()->json(new ExplorationPatientCollection($physicalExam),200);
    }
    //mostrar una exploracion del paciente
    public function showOnePhysicalExploration(PhysicalExam $physicalExam, ExplorationPatient $explorationPatient)
    {
       //$this->authorize('view',$emergencyContact);
       $explorationPatient= $physicalExam->explorationPatient()->where('id',$explorationPatient->id)->firstOrFail();
        return response()->json($explorationPatient,200);
        // foreign key en modelo
    }   
    //agregar examen fisico
    public function store(Request $request , PhysicalExam $physicalExam)
    {
        //$this->authorize('create',PhysicalExam::class);
        $request->validate(self::$rules, self::$messages);
        $physicalExam = new PhysicalExam($request->all());
        $physicalExam->save();
        //return response()->json($physicalExam, 201);
        return response()->json(new PhysicalExamResource($physicalExam), 201);
    }
    //actualizar examen fisico
    public function update(Request $request, Patient $patient, PhysicalExam $physicalExam)
    {
        //$this->authorize('update', $physicalExam);
        $request->validate(self::$repulses, self::$messages);
        $physicalExam->update($request->all());
        return response()->json($physicalExam, 200);
    }
    //borrar examen fisico
    public function delete( Patient $patient, PhysicalExam $physicalExam)
    {
        //$this->authorize('update', $physicalExam);
        $physicalExam->delete();
        return response()->json(null, 204);
    }
}
