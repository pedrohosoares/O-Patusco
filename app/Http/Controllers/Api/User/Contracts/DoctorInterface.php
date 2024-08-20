<?php
namespace App\Http\Controllers\Api\User\Contracts;

use Illuminate\Http\Request;

interface DoctorInterface
{
    public function index(Request $request);
}