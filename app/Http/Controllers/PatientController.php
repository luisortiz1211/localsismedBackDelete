<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\User;
use App\EmergencyContact;
use App\PersonalHistory;
use App\DrugAllergies;
use App\FamilyHistory;
use App\PhysicalExam;
use App\ExplorationPatient;
use App\ImageRecipie;
use App\DrugsRecipie;

use App\Http\Resources\Patient as PatientResource;
use App\Http\Resources\PatientCollection;
use App\Http\Resources\EmergencyContact as EmergencyContactResource;
use App\Http\Resources\EmergencyContactCollection;
use App\Http\Resources\PersonalHistory as PersonalHistoryResource;
use App\Http\Resources\PersonalHistoryCollection;
use App\Http\Resources\DrugAllergies as DrugAllergiesResource;
use App\Http\Resources\DrugAllergiesCollection;
use App\Http\Resources\FamilyHistory as FamilyHistoryResource;
use App\Http\Resources\FamilyHistoryCollection;
use App\Http\Resources\PhysicalExam as PhysicalExamResource;
use App\Http\Resources\PhysicalExamCollection;
use App\Http\Resources\ExplorationPatient as ExplorationPatientResource;
use App\Http\Resources\ExplorationPatientCollection;
use App\Http\Resources\ImageRecipie as ImageRecipieResource;
use App\Http\Resources\ImageRecipieCollection;
use App\Http\Resources\DrugsRecipie as DrugsRecipieResource;
use App\Http\Resources\DrugsRecipieCollection;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class PatientController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attribute es obligatorio ',
        'unique' => 'El campo :attribute es obligatorio'
    ];
    public static $rules = [
        'ci' => 'required|unique:patients|numeric',
        'name' => 'required|string',
        'lastName' => 'required|string',
        'sex' => 'required|numeric',
        'civilStatus' => 'required|numeric',
        'birthay' => 'required|date',
        'employment' => 'required|string',
        'email' => 'required|unique:patients|email',
        'movil' => 'required|numeric',
        'landline' => 'required|numeric',
        'address' => 'required|string|max:255',
        'nationality' => 'required|string',
        'city' => 'required|string',
        'parish' => 'required|string',
    ];
    public static $repulses = [
        'ci' => 'numeric',
        'name' => 'string',
        'lastName' => 'string',
        'sex' => 'numeric',
        'civilStatus' => 'numeric',
        'birthay' => 'date',
        'employment' => 'string',
        'email' => 'email',
        'movil' => 'numeric',
        'landline' => 'numeric',
        'address' => 'string|max:255',
        'nationality' => 'required|string',
        'city' => 'string',
        'parish' => 'string',
    ];
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    // muestra los pacientes
    public function index()
    {
        //$this->authorize('view',Patient::class);
        return new PatientCollection(Patient::paginate(10));
    }
    //mostrar paciente id
    public function show(Patient $patient)
    {
        //$this->authorize('view', $patient);
        return response()->json(new PatientResource($patient), 200);
    }
    // muestra los pacientes de eses usuario
    public function showPatients()
    {
        $user = Auth::user();
        return response()->json(PatientResource::collection($user->patients), 200);
    }
    //mostrar contactos del paciente
    public function showContacts(Patient $patient, EmergencyContact $emergencyContact)
    {
        $this->authorize('view', $patient);
        Patient::class;
        $patient = $emergencyContact->where('patient_id', $patient['id'])->get();
        return response()->json(new EmergencyContactCollection($patient), 200);
    }
    //mostrar enfermedades de un paciente
    public function showPersonalHistory(Patient $patient, PersonalHistory $personalHistory)
    {
        //$this->authorize('view',$patient);
        Patient::class;
        $patient = $personalHistory->where('patient_id', $patient['id'])->get();
        return response()->json(new PersonalHistoryCollection($patient), 200);
    }
    //mostrar las alergias del paciente
    public function showDrugAllergies(Patient $patient, DrugAllergies $drugAllergies)
    {
        //$this->authorize('view',$patient);
        Patient::class;
        $patient = $drugAllergies->where('patient_id', $patient['id'])->get();
        return response()->json(new DrugAllergiesCollection($patient), 200);
    }
    // mostrar los antecedentes familiares
    public function showFamilyHistory(Patient $patient, FamilyHistory $familyHistory)
    {
        //$this->authorize('view',$patient);
        Patient::class;
        $patient = $familyHistory->where('patient_id', $patient['id'])->get();
        return response()->json(new FamilyHistoryCollection($patient), 200);
    }
    // mostrar los examenes fisicos
    public function showPhysicalExams(Patient $patient, PhysicalExam $physicalExam)
    {
        //$this->authorize('view',$physicalExam);
        Patient::class;
        $patient = $physicalExam->where('patient_id', $patient['id'])->get();
        return response()->json(new PhysicalExamCollection($patient), 200);
    }
    // buscar paciente por ci
    public function showMyPatients($nipPatient)
    {
        $patient = DB::table('patients')->where('ci', 'like', '%' . $nipPatient . '%')->get();
        return response()->json(new PatientCollection($patient), 201);
    }
    //mostrar exploraciones del paciente
    public function showExplorationPatient(Patient $patient, ExplorationPatient $explorationPatient)
    {
        //$this->authorize('view',$physicalExam);
        Patient::class;
        $patient = $explorationPatient->where('physicalExam_id', $patient['id'])->get();
        return response()->json(new ExplorationPatientCollection($patient), 200);
    }
    //mostrar imagenes del paciente
    public function showImageRecipies(Patient $patient, ImageRecipie $imageRecipie)
    {
        //$this->authorize('view',$physicalExam);
        Patient::class;
        $patient = $imageRecipie->where('exploration_id', $patient['id'])->get();
        return response()->json(new ImageRecipieCollection($patient), 200);
    }
    //mostrar medicamentos de un paciente
    public function showDrugsRecipies(Patient $patient, DrugsRecipie $drugsRecipie)
    {
        //$this->authorize('view',$physicalExam);
        Patient::class;
        $patient = $drugsRecipie->where('exploration_id', $patient['id'])->get();
        return response()->json(new DrugsRecipieCollection($patient), 200);
    }
    // filtrar paciente
    public function filter($patientSearch)
    {
        $patient = DB::table('patients')->where('ci', 'like', '%' . $patientSearch . '%')->get();
        return response()->json(new PatientCollection($patient), 201);
    }
    //crear un paciente
    public function store(Request $request, Patient $patient)
    {
        //$this->authorize('create',Patient::class);
        $request->validate(self::$rules, self::$messages);
        $patient = new Patient($request->all());
        $patient->save();
        return response()->json(new PatientResource($patient), 201);
    }
    // actualizar paciente
    public function update(Request $request, Patient $patient)
    {
        //$this->authorize('update', $patient);
        $request->validate(self::$repulses, self::$messages);
        $patient->update($request->all());
        return response()->json($patient, 200);
    }
    // borrar un paciente
    public function delete(Patient $patient)
    {
        //$this->authorize('delete', $patient);
        $patient->delete();
        return response()->json(null, 204);
    }
}
