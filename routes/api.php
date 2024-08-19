<?php

use App\Http\Controllers\Api\Login\LoginController;
use App\Http\Controllers\Api\User\ClientController;
use App\Http\Controllers\Api\User\DoctorController;
use App\Http\Controllers\Api\User\ReceptionController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth:sanctum'])->group(function () {
    //Utente
    Route::post('/clients/orders', [ClientController::class, 'storeOrder']);
    //Recepcionista
    Route::get('/receptionists/schedules', [ReceptionController::class, 'allSchedules']);
    Route::post('/receptionists/schedules/join_doctor/{schedule_id}/{doctor_id}', [ReceptionController::class, 'joinScheduleToDoctor']);
    Route::post('/receptionists/schedules/store', [ReceptionController::class, 'createSchedule']);
    Route::put('/receptionists/schedules/update/{id}', [ReceptionController::class, 'updateSchedule']);
    Route::post('/receptionists/schedules/remove_doctor/{schedule_id}/{doctor_id}', [ReceptionController::class, 'removeScheduleToDoctor']);
    Route::delete('/receptionists/schedules/{id}', [ReceptionController::class, 'deleteSchedule']);
    Route::get('/receptionists/schedules/show/{id}', [ReceptionController::class, 'showSchedule']);
    //Medico
    Route::get('/doctors/schedules', [DoctorController::class, 'allSchedules']);
    Route::put('/doctors/schedules/{id}', [DoctorController::class, 'updateSchedule']);
    Route::get('/doctors/schedules/show/{id}', [DoctorController::class, 'showSchedule']);
});

Route::post('/login',[LoginController::class,'login'])->name('login');
