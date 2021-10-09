<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DrugAllergies;
use App\Patient;
use App\Http\Resources\DrugAllergies as DrugAllergiesResource;
use App\Http\Resources\DrugAllergiesCollection;

class DrugAllergiesController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attribute es obligatorio',
    ];
    public static $rules = [
        'drugName' => 'required|string|max:255',
        'drugSymptom' => 'required|string|max:255',
        'drugRemark' => 'required|string|max:255',
    ];
    public static $repulses = [
        'drugName' => 'string',
        'drugSymptom' => 'string',
        'drugRemark' => 'string',
    ];
    //Se muestra todas las alergias
    public function index()
    {
        //$this->authorize('view',DrugAllergies::class);
        return response()->json(
            DrugAllergiesResource::collection(DrugAllergies::all()),
            200
        );
    }
    //muestra laa alergias de un usuario en especifico
    public function show(DrugAllergies $drugAllergie)
    {
       // $this->authorize('view',$drugAllergie);
        return response()->json(new DrugAllergiesResource($drugAllergie), 200);
    }
    //mostrar alergias de un paciente
    public function showOneDrugAllergies(Patient $patient,DrugAllergies $drugAllergie)
      {
         //$this->authorize('view',$emergencyContact);
          $drugAllergie= $patient->drugAllergie()->where('id',$drugAllergie->id)->firstOrFail();
          return response()->json($drugAllergie,200);
      }
    //crear alergia del paciente
    public function store(Request $request, DrugAllergies $drugAllergie)
    {
        //$this->authorize('create',DrugAllergies::class);
        $request->validate(self::$rules, self::$messages);
        $drugAllergie = new DrugAllergies($request->all());
        $drugAllergie->save();
        //$drugAllergie = DrugAllergies::create($request->all());
        return response()->json(new DrugAllergiesResource($drugAllergie), 201);
    }
    //actualizar alergia del paciente
    public function update(Request $request,Patient $patient, DrugAllergies $drugAllergie)
    {
       // $this->authorize('update', $drugAllergie);
        $request->validate(self::$repulses, self::$messages);
        $drugAllergie->update($request->all());
        return response()->json($drugAllergie, 200);
    }
    //eliminar alergia del paciente
    public function delete(Patient $patient, DrugAllergies $drugAllergie)
    {
       // $this->authorize('delete',$drugAllergie);
        $drugAllergie->delete();
        return response()->json(null, 204);
    }
}
