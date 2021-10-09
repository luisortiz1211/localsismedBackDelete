<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FamilyHistory;
use App\Patient;
use App\Http\Resources\FamilyHistory as FamilyHistoryResource;
use App\Http\Resources\FamilyHistoryCollection;

class FamilyHistoryController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attribute es obligatorio ',
    ];
    public static $rules = [
        'nameCondition' => 'required|string',
        'yearCondition' => 'required|string',
        'commentCondition'=>'required|string'
    ];
    public static $repulses = [
        'nameCondition' => 'string',
        'yearCondition' => 'string',
        'commentCondition'=>'string'
    ];
    //muestra los antecedente de familiar
    public function index()
    {
        //$this->authorize('view',FamilyHistory::class);
        return response()->json(
            FamilyHistoryResource::collection(FamilyHistory::all()),
            200
        );
    }
    // muestra antecedente de familiar de uno especifico
    public function show(FamilyHistory $familyHistory)
    {
        //$this->authorize('view',$familyHistory);
        return response()->json(new FamilyHistoryResource($familyHistory), 200);
    }
    //mostrar antecedente familiar
    public function showOneFamilyHistory(Patient $patient,FamilyHistory $familyHistory)
    {
       //$this->authorize('view',$emergencyContact);
       $familyHistory = $patient->familyHistory()->where('id',$familyHistory->id)->firstOrFail();
        return response()->json($familyHistory,200);
    }
    // crear antecedente de familiar
    public function store(Request $request, FamilyHistory $familyHistory)
    {
        //$this->authorize('create',FamilyHistory::class);
        $request->validate(self::$rules, self::$messages);
        $familyHistory = new FamilyHistory($request->all());
        $familyHistory->save();
        return response()->json(new FamilyHistoryResource($familyHistory), 201);
    }
    //actualizar antecedente de familiar
    public function update(Request $request, Patient $patient,FamilyHistory $familyHistory)
    {
        //$this->authorize('update', $familyHistory);
        $request->validate(self::$repulses, self::$messages);
        $familyHistory->update($request->all());
        return response()->json($familyHistory, 200);
    }
    //borrrar antecedente de familiar
    public function delete(Patient $patient, FamilyHistory $familyHistory)
    {
        //$this->authorize('delete',$familyHistory);
        $familyHistory->delete();
        return response()->json(null, 204);
    }
}
