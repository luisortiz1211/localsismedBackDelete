<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExplorationPatient;
use App\PhysicalExam;
use App\ImageRecipie;
use App\DrugsRecipie;
use App\Patient;
use App\Http\Resources\ExplorationPatient as ExplorationPatientResource;
use App\Http\Resources\ExplorationPatientCollection;
use App\Http\Resources\ImageRecipieCollection;
use App\Http\Resources\DrugsRecipieCollection;


use App\User;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;

class ExplorationPatientController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attibute es obligatorio ',
    ];
    public static $rules = [
        'headExplo' => ' nullable|string|max:255',
        'chestExplo' => ' nullable|string|max:255',
        'extremitiesExplo' => ' nullable|string|max:255',
        'neckExplo' => ' nullable|string|max:255',
        'stomachExplo' => ' nullable|string|max:255',
        'genitalsExplo' => ' nullable|string|max:255',
        'forecastExplo' => ' nullable|string|max:255',
        'diagnosisExplo' => ' nullable|string|max:255',
        'treatmentExplo' => ' nullable|string|max:255',
        'commentExplo' => ' nullable|string|max:255',
    ];
    public static $repulses = [
        'headExplo' => ' string',
        'chestExplo' => 'string',
        'extremitiesExplo' => 'string',
        'neckExplo' => 'string',
        'stomachExplo' => 'string',
        'genitalsExplo' => 'string',
        'forecastExplo' => 'string',
        'diagnosisExplo' => 'string',
        'treatmentExplo' => 'string',
        'commentExplo' => 'string',
    ];
    // mostrar todas las exploraciones de pacientes
    public function index()
    {
        //$this->authorize('view',ExplorationPatient::class);
        return response()->json(
            ExplorationPatientResource::collection(ExplorationPatient::all()),
            200
        );
    }
      // muestra los examenes fisicos de un paciente
      public function show(ExplorationPatient $explorationPatient)
      {
         $this->authorize('view',$explorationPatient);
          return response()->json(new ExplorationPatientResource($explorationPatient), 200);
      }
    // mostrar una exploracion
    public function showOnePatientExploration(Patient $patient,ExplorationPatient $explorationPatient)
    {
        //$this->authorize('view',$explorationPatient);
        $explorationPatient= $patient->explorationPatient()->where('id',$explorationPatient->id)->firstOrFail();
        return response()->json($explorationPatient, 200);
    }
    //Pacientes ingresados por el usuario
    public function showExplorationPatients(PhysicalExam $physicalExam,ExplorationPatient $explorationPatient) {
   // $this->authorize('view',$physicalExam);
       PhysicalExam::class;
        $physicalExam = $explorationPatient->where('physicalExam_id', $physicalExam['id'])->get();
        return response()->json(new ExplorationPatientCollection($physicalExam), 200);
    }
    // mostrar pedido de imagen
    public function showExploreImage(Patient $patient, ExplorationPatient $explorationPatient,ImageRecipie $imageRecipie) 
    {
        //$this->authorize('view',$explorationPatient);
        ExplorationPatient::class;
        $explorationPatient = $imageRecipie->where('exploration_id', $explorationPatient['id'])->get();
            return response()->json(new ImageRecipieCollection($explorationPatient),200);
    }
    // mostrar receta de medicamentos
    public function showExploreDrugs(Patient $patient, ExplorationPatient $explorationPatient, DrugsRecipie $drugsRecipie) 
    {
        //$this->authorize('view',$explorationPatient);
        ExplorationPatient::class;
        $explorationPatient = $drugsRecipie->where('exploration_id', $explorationPatient['id'])->get();
            return response()->json(new DrugsRecipieCollection($explorationPatient),200);
    }
    // crear una exploracion
    public function store(Request $request, ExplorationPatient $explorationPatient)
    {
        //$this->authorize('create',ExplorationPatient::class);
        $request->validate(self::$rules, self::$messages);
        $explorationPatient = new ExplorationPatient($request->all());
        $explorationPatient->save();
        return response()->json(new ExplorationPatientResource($explorationPatient), 201);
    }
//-----------------------------------------storePhysicalExplorationPatient
    public function storePhysicalExplorationPatient(Request $request,Patient $patient , PhysicalExam $physicalExam, ExplorationPatient $explorationPatient)
    {
        //$this->authorize('create',ExplorationPatient::class);
        $request->validate(self::$rules, self::$messages);
        $explorationPatient = new ExplorationPatient($request->all());
        $explorationPatient->save();
        //$explorationPatient = ExplorationPatient::create($request->all());
        return response()->json(new ExplorationPatientResource($explorationPatient), 201);
    }
    public function showPhysicalExplorationPatient(Patient $patient, PhysicalExam $physicalExam,ExplorationPatient $explorationPatient) {
        // $this->authorize('view',$physicalExam);
            PhysicalExam::class;
            $physicalExam = $explorationPatient->where('physicalExam_id','patient_id', $physicalExam['id'])->get();
             return response()->json(new ExplorationPatientCollection($physicalExam), 200);
         }
    public function update(Request $request,PhysicalExam $physicalExam,ExplorationPatient $explorationPatient
    ) {
        //$this->authorize('update', $explorationPatient);
        $request->validate(self::$repulses, self::$messages);
        $explorationPatient->update($request->all());
        return response()->json($explorationPatient, 200);
    }
    //actualizar exploracion del paciente
    public function updateExploration(Request $request,Patient $patient,ExplorationPatient $explorationPatient
    ) {
        //$this->authorize('update', $explorationPatient);
        $request->validate(self::$repulses, self::$messages);
        $explorationPatient->update($request->all());
        return response()->json($explorationPatient, 200);
    }
    //borrar una exploracion
    public function delete(PhysicalExam $physicalExam,ExplorationPatient $explorationPatient)
    {
        //$this->authorize('delete',$explorationPatient);
        $explorationPatient->delete();
        return response()->json(null, 204);
    }
}
