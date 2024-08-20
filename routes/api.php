<?php

use App\Http\Controllers\Api\Login\LoginController;
use App\Http\Controllers\Api\Order\ScheduleController;
use App\Http\Controllers\Api\User\ClientController;
use App\Http\Controllers\Api\User\DoctorController;
use App\Http\Controllers\Api\User\ReceptionController;
use Illuminate\Support\Facades\Route;



//Utente
Route::post('/clients/orders', [ClientController::class, 'storeOrder']);

Route::middleware(['auth:sanctum'])->group(function () {
    //Recepcionista
    Route::get('/receptionists/schedules', [ScheduleController::class, 'index']);
    Route::get('/receptionists/schedules/show/{id}', [ScheduleController::class, 'show']);
    Route::delete('/receptionists/schedules/{id}', [ScheduleController::class, 'destroy']);
    Route::post('/receptionists/schedules/join_doctor/{schedule_id}/{doctor_id}', [ReceptionController::class, 'joinScheduleToDoctor']);
    Route::post('/receptionists/schedules/store', [ClientController::class, 'storeOrder']);
    Route::put('/receptionists/schedules/update/{id}', [ScheduleController::class, 'update']);
    Route::post('/receptionists/schedules/remove_doctor/{schedule_id}/{doctor_id}', [ReceptionController::class, 'removeScheduleToDoctor']);
    Route::get('/doctors', [DoctorController::class, 'index']);
    //Medico
    Route::get('/doctors/schedules', [ScheduleController::class, 'index']);
    Route::put('/doctors/schedules/{id}', [DoctorController::class, 'updateSchedule']);
    Route::get('/doctors/schedules/show/{id}', [ScheduleController::class, 'index']);
});

Route::post('/login',[LoginController::class,'login'])->name('login');
Route::post('/logout',[LoginController::class,'logout'])->name('logout');
