<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImageRecipie;
use App\ExplorationPatient;
use App\Patient;
use App\Http\Resources\ImageRecipie as ImageRecipieResource;
use App\Http\Resources\ImageRecipieCollection;



use App\User;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;

class ImageRecipieController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attribute es obligatorio ',
    ];
    public static $rules = [
        'codimage' => 'required|numeric',
        'nameImageRecipie' => 'required|string',
    ];
    public static $repulses = [
        'codimage' => 'numeric',
        'nameImageRecipie' => 'string',
    ];
    // muestra las imagenes de los pacientes
    public function index()
    {
        //$this->authorize('view',ImageRecipie::class);
        return response()->json(
            ImageRecipieResource::collection(ImageRecipie::all()),
            200
        );
    }
    // muestra las imagenes de un paciente
    public function show(ImageRecipie $imageRecipie)
    {
        //$this->authorize('view',$imageRecipie);
        return response()->json(new ImageRecipieResource($imageRecipie), 200);
    }
    //mostrar imagenes de un paciente desde exploracion
    public function showOnePatientImage(ExplorationPatient $explorationPatient, ImageRecipie $imageRecipie)
    {
        //$this->authorize('view',$emergencyContact);
        $imageRecipie = $explorationPatient->imageRecipie()->where('id', $imageRecipie->id)->firstOrFail();
        return response()->json($imageRecipie, 200);
    }
    //mostrar imagenes desde paciente
    public function showImagePatient(Patient $patient, ImageRecipie $imageRecipie)
    {
        //$this->authorize('view',$emergencyContact);
        $imageRecipie = $patient->imageRecipie()->where('id', $imageRecipie->id)->firstOrFail();
        return response()->json($imageRecipie, 200);
    }
    //Imagenes enviadas por el usuario
    public function showImageRecipies(User $user, ImageRecipie $imageRecipie)
    {
        //$this->authorize('view',$imageRecipie);
        User::class;
        $user = $imageRecipie->where('user_id', $user['id'])->get();
        return response()->json(new ImageRecipieCollection($user), 200);
    }
    // crear receta imagen
    public function store(Request $request, ImageRecipie $imageRecipie)
    {
        //$this->authorize('create',ImageRecipie::class);
        $request->validate(self::$rules, self::$messages);
        $imageRecipie = ImageRecipie::create($request->all());
        $imageRecipie->save();
        return response()->json(new ImageRecipieResource($imageRecipie), 201);
    }
    //actualizar receta imagen
    public function update(Request $request, ExplorationPatient $explorationPatient, ImageRecipie $imageRecipie)
    {
        //$this->authorize('update', $imageRecipie);
        $request->validate(self::$repulses, self::$messages);
        $imageRecipie->update($request->all());
        return response()->json($imageRecipie, 200);
    }
    //actualizar receta imagen desde paciente
    public function updateImagePatient(Request $request, Patient $patient, ImageRecipie $imageRecipie)
    {
        //$this->authorize('update', $imageRecipie);
        $request->validate(self::$repulses, self::$messages);
        $imageRecipie->update($request->all());
        return response()->json($imageRecipie, 200);
    }
    //borrar receta imagen
    public function delete(ExplorationPatient $explorationPatient, ImageRecipie $imageRecipie)
    {
        //$this->authorize('delete', $imageRecipie);
        $imageRecipie->delete();
        return response()->json(null, 204);
    }
}
