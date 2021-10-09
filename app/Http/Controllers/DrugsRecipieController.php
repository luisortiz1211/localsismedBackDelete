<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DrugsRecipie;
use App\ExplorationPatient;
use App\Patient;
use App\Http\Resources\DrugsRecipie as DrugsRecipieResource;
use App\Http\Resources\DrugsRecipieCollection;

use App\User;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;

class DrugsRecipieController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attribute es obligatorio ',
    ];
    public static $rules = [
        'coddrug' => 'required|numeric|max:255',
        'nameDrugRecipie' => 'required|string|max:255',
    ];
    public static $repulses = [
        'coddrug' => 'numeric',
        'nameDrugRecipie' => 'string',
    ];
    public function index()
    {
        //$this->authorize('view',DrugsRecipie::class);
        return response()->json(
            DrugsRecipieResource::collection(DrugsRecipie::all()),
            200
        );
    }
    public function show(DrugsRecipie $drugsRecipie)
    {
        //$this->authorize($drugsRecipie);
        return response()->json(new DrugsRecipieResource($drugsRecipie), 200);
    }

    //Recetas enviadas por el usuario
    public function showDrugsRecipie(User $user, DrugsRecipie $drugsRecipie)
    {
        //$this->authorize('view',$drugsRecipie);
        User::class;
        $user = $drugsRecipie->where('user_id', $user['id'])->get();
        return response()->json(new DrugsRecipieCollection($user), 200);
    }
    //mostrar las imagenes de paciente
    public function showDrugsRecipiePatient(Patient $patient, DrugsRecipie $drugsRecipie)
    {
         //$this->authorize('view',$emergencyContact);
         $drugsRecipie = $patient->drugsRecipie()->where('id',$drugsRecipie->id)->firstOrFail();
         return response()->json($drugsRecipie,200);
    }
// mostrar los medicamentos de un paciente desd exploracio   n
   public function showOnePatientDrugs(ExplorationPatient $explorationPatient, DrugsRecipie $drugsRecipie)
   {   
        //$this->authorize('view',$emergencyContact);   
        $drugsRecipie = $explorationPatient->drugsRecipie()->   where('id',$drugsRecipie->id)->firstOrFail();
        return response()->json($drugsRecipie,200);
   }

   // crear una receta de medicamento
    public function store(Request $request, DrugsRecipie $drugsRecipie)
    {
       // $this->authorize('create',DrugsRecipie::class);
        $request->validate(self::$rules, self::$messages);
        $drugsRecipie = new DrugsRecipie($request->all());
        $drugsRecipie->save();
        //$drugsRecipie = DrugsRecipie::create($request->all());
        return response()->json(new DrugsRecipieResource($drugsRecipie), 201);
    }
    //actualizar receta de medicamento
    public function update(Request $request, ExplorationPatient $explorationPatient , DrugsRecipie $drugsRecipie)
    {
        //$this->authorize('update', $drugsRecipie);
        $request->validate(self::$repulses, self::$messages);
        $drugsRecipie->update($request->all());
        return response()->json($drugsRecipie, 200);
    }
     //actualizar receta de medicamento
     public function updateDrugsRecipiePatient(Request $request,Patient $patient, DrugsRecipie $drugsRecipie)
     {
         //$this->authorize('update', $drugsRecipie);
         $request->validate(self::$repulses, self::$messages);
         $drugsRecipie->update($request->all());
         return response()->json($drugsRecipie, 200);
     }
    //borrar receta de medicamento
    public function delete(ExplorationPatient $explorationPatient, DrugsRecipie $drugsRecipie)
    {
       // $this->authorize('delete',$imageRecipie);
        $drugsRecipie->delete();
        return response()->json(null, 204);
    }
}
