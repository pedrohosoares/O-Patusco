<?php
namespace App\Http\Controllers\Api\User\Contracts;

use Illuminate\Http\Request;

interface ReceptionInterface
{
    public function allSchedules(Request $request);

    public function showSchedule(int $id);

    public function joinScheduleToDoctor(int $schedule_id,int $doctor_id);

    public function createSchedule(array $data);

    public function updateSchedule(int $id,array $data);

    public function removeScheduleToDoctor(int $schedule_id,int $doctor_id);

    public function deleteSchedule(int $id);
}