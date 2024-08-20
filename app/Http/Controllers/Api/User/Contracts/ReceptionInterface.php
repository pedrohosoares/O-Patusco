<?php
namespace App\Http\Controllers\Api\User\Contracts;

use Illuminate\Http\Request;

interface ReceptionInterface
{
    public function joinScheduleToDoctor(int $schedule_id,int $doctor_id);

    public function removeScheduleToDoctor(int $schedule_id,int $doctor_id);

}