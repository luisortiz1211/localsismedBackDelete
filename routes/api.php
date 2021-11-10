<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('login', 'App\\Http\\Controllers\\UserController@authenticate');

Route::group(['middleware' => ['jwt.verify']], function () {
    //--------- Rutas de usuario -----------------------------
    Route::get('users', 'App\\Http\\Controllers\\UserController@index');
    Route::post('register', 'App\\Http\\Controllers\\UserController@register');
    Route::get('user', 'App\\Http\\Controllers\\UserController@getAuthenticatedUser');
    Route::get('users/{user}', 'App\\Http\\Controllers\\UserController@show');
    Route::put('users/{user}', 'App\\Http\\Controllers\\UserController@update');
    Route::post('logout', 'App\\Http\\Controllers\\UserController@logout');
    
    //----------Rutas pacientes desde usuario-----------------------------
    
    //Route::get('user/patients/{patient}', 'PatientController@showMyPatients');
    Route::get('user/patients', 'App\\Http\\Controllers\\PatientController@showPatients');
    Route::post('user/patients', 'App\\Http\\Controllers\\PatientController@store');
    Route::put('user/patients/{patient}', 'App\\Http\\Controllers\\PatientController@update');
    Route::post('patients', 'App\\Http\\Controllers\\PatientController@store');
    Route::put('patients/{patient}', 'App\\Http\\Controllers\\PatientController@update');
    //Route::delete('user/patients/{patient}','PatientController@delete');
    
    //---------Rutas de pacientes-----------------------------
    //Route::get('users/{user}/patients/{patient}', 'PatientController@show');
    Route::get('patients/all', 'App\\Http\\Controllers\\PatientController@showAll');
    
    Route::get('patients', 'App\\Http\\Controllers\\PatientController@index');
    Route::get('patients/{patient}', 'App\\Http\\Controllers\\PatientController@show');
    Route::get('patients/{patient}/emergency_contacts', 'App\\Http\\Controllers\\PatientController@showContacts');
    Route::get('patients/{patient}/drug_allergies', 'App\\Http\\Controllers\\PatientController@showDrugAllergies');
    Route::get('patients/{patient}/family_histories', 'App\\Http\\Controllers\\PatientController@showFamilyHistory');
    Route::get('patients/{patient}/personal_histories', 'App\\Http\\Controllers\\PatientController@showPersonalHistory');
    Route::get('patients/{patient}/physical_exams', 'App\\Http\\Controllers\\PatientController@showPhysicalExams');
    Route::get('patients/{patient}/exploration_patients', 'App\\Http\\Controllers\\PatientController@showExplorationPatient');
    Route::get('patients/{patient}/image_recipies', 'App\\Http\\Controllers\\PatientController@showImageRecipies');
    Route::get('searching/{search}','App\\Http\\Controllers\\PatientController@search' );

    //Route::get('patients/{patient}/drugs_recipies', 'App\\Http\\Controllers\\PatientController@showdrug');
    //Route::delete('patients/{patient}', 'PatientController@delete');

    //----------Rutas pacientes agendados-----------------------------
    Route::get('schedule_days/all', 'App\\Http\\Controllers\\ScheduleDayController@showAll');
    Route::get('schedule_days', 'App\\Http\\Controllers\\ScheduleDayController@index');
    Route::get('schedule_days/{schedule_day}', 'App\\Http\\Controllers\\ScheduleDayController@show');
    
    Route::get('patients/{patient}/schedule_days', 'App\\Http\\Controllers\\ScheduleDayController@showScheduleDayPatient');
    
    Route::get('users/{user}/schedule_days', 'App\\Http\\Controllers\\ScheduleDayController@showScheduleDayUser');
   // Route::post('users/{user}/schedule_days', 'App\\Http\\Controllers\\ScheduleDayController@store');
   Route::post('users/{user}/schedule_days', 'App\\Http\\Controllers\\ScheduleDayController@store');
  
   

    //Route::get('schedule_days/{schedule_day}', 'App\\Http\\Controllers\\ScheduleDayController@filterDaySchedule');
    Route::get('users/{user}/schedule_days/{schedule_day}', 'App\\Http\\Controllers\\ScheduleDayController@showScheduleDay');
    Route::put('schedule_days/{schedule_day}', 'App\\Http\\Controllers\\ScheduleDayController@update');
    Route::delete('users/{user}/schedule_days/{scheduleDay}', 'App\\Http\\Controllers\\ScheduleDayController@delete');
    Route::get('schedule_days/filter/state1', 'App\\Http\\Controllers\\ScheduleDayController@findStatePendiente');
    Route::get('schedule_days/filter/state2', 'App\\Http\\Controllers\\ScheduleDayController@findStateAtendido');
    Route::get('schedule_days/filter/state3', 'App\\Http\\Controllers\\ScheduleDayController@findStateCancelado');


    //----------Rutas contactos de emergencia
    //Route::get('emergency_contacts', 'EmergencyContactController@index');
    Route::get('emergency_contacts/{emergency_contact}', 'App\\Http\\Controllers\\EmergencyContactController@show');
    Route::post('patients/{patient}/emergency_contacts', 'App\\Http\\Controllers\\EmergencyContactController@store');
    Route::get('patients/{patient}/emergency_contacts/{emergency_contact}', 'App\\Http\\Controllers\\EmergencyContactController@showOneEmergencyContact');
    Route::put('patients/{patient}/emergency_contacts/{emergency_contact}', 'App\\Http\\Controllers\\EmergencyContactController@update');
    Route::delete('emergency_contacts/{emergency_contact}', 'App\\Http\\Controllers\\EmergencyContactController@delete');

    //----------Enfermedades que padece en paciente-----------------------------
    //Route::get('personal_histories', 'PersonalHistoryController@index');
    Route::get('personal_histories/{personal_history}', 'App\\Http\\Controllers\\PersonalHistoryController@show');
    Route::post('patients/{patient}/personal_histories', 'App\\Http\\Controllers\\PersonalHistoryController@store');
    Route::get('patients/{patient}/personal_histories/{personal_history}', 'App\\Http\\Controllers\\PersonalHistoryController@ShowOnePersonalHistory');
    Route::put('patients/{patient}/personal_histories/{personal_history}', 'App\\Http\\Controllers\\PersonalHistoryController@update');
    Route::delete('patients/{patient}/personal_histories/{personal_history}', 'App\\Http\\Controllers\\PersonalHistoryController@delete');

    //----------Rutas alergias del paciente-----------------------------
    //Route::get('drug_allergies', 'DrugAllergiesController@index');
    Route::get('drug_allergies/{drug_allergie}', 'App\\Http\\Controllers\\DrugAllergiesController@show');
    Route::post('patients/{patient}/drug_allergies', 'App\\Http\\Controllers\\DrugAllergiesController@store');
    Route::get('patients/{patient}/drug_allergies/{drug_allergie}', 'App\\Http\\Controllers\\DrugAllergiesController@showOneDrugAllergies');
    Route::put('patients/{patient}/drug_allergies/{drug_allergie}', 'App\\Http\\Controllers\\DrugAllergiesController@update');
    Route::delete('patients/{patient}/drug_allergies/{drug_allergie}', 'App\\Http\\Controllers\\DrugAllergiesController@delete');

    //----------Rutas de antecedentes familiares-----------------------------
    //Route::get('family_histories', 'FamilyHistoryController@index');
    Route::get('family_histories/{family_history}', 'App\\Http\\Controllers\\FamilyHistoryController@show');
    Route::post('patients/{patient}/family_histories', 'App\\Http\\Controllers\\FamilyHistoryController@store');
    Route::get('patients/{patient}/family_histories/{family_history}', 'App\\Http\\Controllers\\FamilyHistoryController@showOneFamilyHistory');
    Route::put('patients/{patient}/family_histories/{family_history}', 'App\\Http\\Controllers\\FamilyHistoryController@update');
    Route::delete('patients/{patient}/family_histories/{family_history}', 'App\\Http\\Controllers\\FamilyHistoryController@delete');
    
    //----------Rutas de examenes fisicos-----------------------------
    //Route::get('physical_exams', 'PhysicalExamController@index');
    Route::get('physical_exams/{physical_exam}', 'App\\Http\\Controllers\\PhysicalExamController@show');
    
    Route::post('patients/{patient}/physical_exams', 'App\\Http\\Controllers\\PhysicalExamController@store');

    Route::get('patients/{patient}/physical_exams/{physical_exam}', 'App\\Http\\Controllers\\PhysicalExamController@showOnePhysicalExam');
    Route::put('physical_exams/{physical_exam}', 'App\\Http\\Controllers\\PhysicalExamController@update');
    Route::delete('patients/{patient}/physical_exams/{physical_exam}', 'App\\Http\\Controllers\\PhysicalExamsController@delete');

    //-----------Rutas exploraciones a pacientes-----------------------------
    //Route::get('exploration_patients', 'ExplorationPatientController@index');
    Route::get('exploration_patients/{exploration_patient}', 'App\\Http\\Controllers\\ExplorationPatientController@show');  
    //Route::post('patients/{patient}/exploration_patients', 'App\\Http\\Controllers\\ExplorationPatientController@store');
    Route::post('physical_exams/{physical_exam}/exploration_patients', 'App\\Http\\Controllers\\ExplorationPatientController@store');
    

    Route::get('physical_exams/{physical_exam}/exploration_patients', 'App\\Http\\Controllers\\PhysicalExamController@showExplorationPatients');
    //Route::post('physical_exams/{physical_exam}/exploration_patients', 'App\\Http\\Controllers\\PhysicalExamController@store');
    

    Route::get('physical_exams/{physical_exam}/exploration_patients/{exploration_patient}', 'App\\Http\\Controllers\\PhysicalExamController@showOnePhysicalExploration');
    Route::put('physical_exams/{physical_exam}/exploration_patients/{exploration_patient}', 'App\\Http\\Controllers\\ExplorationPatientController@update');
    Route::delete('physical_exams/{physical_exam}/exploration_patients/{exploration_patient}', 'App\\Http\\Controllers\\ExplorationPatientController@delete');
   
    Route::get('patients/{patient}/exploration_patients/{exploration_patient}', 'App\\Http\\Controllers\\ExplorationPatientController@showOnePatientExploration');
    Route::put('patients/{patient}/exploration_patients/{exploration_patient}', 'App\\Http\\Controllers\\ExplorationPatientController@updateExploration');

    //Route::post( 'patients/{patient}/physical_exams/{physical_exam}/exploration_patients','ExplorationPatientController@storePhysicalExplorationPatient');
    //Route::get('patients/{patient}/physical_exams/{physical_exam}/exploration_patients', 'App\\Http\\Controllers\\ExplorationPatientController@showPhysicalExplorationPatient');

    //-----------Rutas imagen receta-----------------------------
    //Route::get('image_recipies', 'ImageRecipieController@index');
    Route::get('image_recipies/{image_recipie}', 'App\\Http\\Controllers\\ImageRecipieController@show');

    Route::get('patients/{patient}/image_recipies/{image_recipie}', 'App\\Http\\Controllers\\ImageRecipieController@showImagePatient');
    Route::put('patients/{patient}/image_recipies/{image_recipie}', 'App\\Http\\Controllers\\ImageRecipieController@updateImagePatient');
    Route::get('exploration_patients/{exploration_patient}/image_recipies', 'App\\Http\\Controllers\\ExplorationPatientController@showExploreImage');
    Route::post('exploration_patients/{exploration_patient}/image_recipies', 'App\\Http\\Controllers\\ImageRecipieController@store');
   // Route::get('exploration_patients/{exploration_patient}/image_recipies/{image_recipie}', 'App\\Http\\Controllers\\ImageRecipieController@showOnePatientImage');
   //Route::put('exploration_patients/{exploration_patient}/image_recipies/{image_recipie}', 'App\\Http\\Controllers\\ImageRecipieController@update');
    Route::delete('exploration_patients/{exploration_patient}/image_recipies/{image_recipie}', 'App\\Http\\Controllers\\ImageRecipieController@delete');
    Route::get('users/{user}/image_recipies', 'App\\Http\\Controllers\\ImageRecipieController@showImageRecipies');

    //-----------Rutas a medicamentos-----------------------------
    //Route::get('drugs_recipies', 'DrugsRecipieController@index');
    Route::get('drugs_recipies/{drugs_recipie}', 'App\\Http\\Controllers\\DrugsRecipieController@show');
    
    Route::get('patients/{patient}/drugs_recipies/{drugs_recipie}', 'App\\Http\\Controllers\\DrugsRecipieController@showDrugsRecipiePatient');
    Route::get('patients/{patient}/drugs_recipies/{drugs_recipie}', 'App\\Http\\Controllers\\DrugsRecipieController@updateDrugsRecipiePatient');
    Route::get('exploration_patients/{exploration_patient}/drugs_recipies', 'App\\Http\\Controllers\\ExplorationPatientController@showExploreDrugs');
    Route::post('exploration_patients/{exploration_patient}/drugs_recipies', 'App\\Http\\Controllers\\DrugsRecipieController@store');
    
    //Route::get('exploration_patients/{exploration_patient}/drugs_recipies/{drugs_recipie}', 'App\\Http\\Controllers\\DrugsRecipieController@showOnePatientDrugs');
    //Route::put('exploration_patients/{exploration_patient}/drugs_recipies/{drugs_recipie}', 'App\\Http\\Controllers\\DrugsRecipieController@update');
    Route::delete('exploration_patients/{exploration_patient}/drugs_recipies/{drugs_recipie}', 'App\\Http\\Controllers\\DrugsRecipieController@delete');
    Route::get('users/{user}/drugs_recipies', 'App\\Http\\Controllers\\DrugsRecipieController@showDrugsRecipie');

    //Route::post('patients/{patient}/drugs_recipies', 'App\\Http\\Controllers\\DrugsRecipieController@store');
   
    //-----------Horartios de usuarios-----------------------------
    Route::get('schedule_users', 'App\\Http\\Controllers\\ScheduleUserController@index');
    Route::get('schedule_users/{schedule_user}', 'App\\Http\\Controllers\\ScheduleUserController@show');
    Route::post('users/{user}/schedule_users', 'App\\Http\\Controllers\\ScheduleUserController@store');
    Route::get('users/{user}/schedule_users', 'App\\Http\\Controllers\\ScheduleUserController@showScheduleUser');
    Route::put('schedule_users/{schedule_user}', 'App\\Http\\Controllers\\ScheduleUserController@update');
    Route::delete('schedule_users/{schedule_user}', 'App\\Http\\Controllers\\ScheduleUserController@delete');
});
