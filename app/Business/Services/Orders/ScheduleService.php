<?php

namespace App\Business\Services\Orders;

use App\Business\Repositories\Orders\ScheduleRepository;
use App\Business\Services\Abstracts\CrudAbstract;
use App\Business\Services\Animals\AnimalService;
use App\Business\Services\Animals\RaceService;
use App\Business\Services\Users\ClientService;
use App\Business\Services\Users\ReceptionService;
use App\Business\Services\Users\UserService;
use App\Http\Resources\ScheduleResource;
use App\Models\Services\Schedule;
use App\Traits\HttpResponseTrait;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class ScheduleService extends CrudAbstract
{
    use HttpResponseTrait;

    protected $repository;
    protected $userService;
    protected $animalService;
    protected $raceService;
    protected $orderService;

    public function __construct(ScheduleRepository $repository)
    {
        $this->repository = $repository;
        $this->userService = app(UserService::class);
        $this->animalService = app(AnimalService::class);
        $this->raceService = app(RaceService::class);
        $this->orderService = app(OrderService::class);
    }

    public function index($request)
    {
        if(Gate::denies('viewAny',Schedule::class)){
            return $this->errorResponse('Ação não permitida');
        }
        return ScheduleResource::collection(parent::index($request));
    }

    public function show(int $id)
    {
        try {        
            if (Gate::denies('view', Schedule::class)) {
                return $this->errorResponse('Ação não permitida');
            }
            return parent::show($id);
        } catch (\Throwable $th) {
            $this->log($th->getMessage());
            return [$th->getMessage()];
        }
        
    }

    public function getSpecific(int $id)
    {
        return $this->repository->getSpecific($id);
    }

    public function update(int $id,array $data)
    {
        try {
            if (Gate::denies('update', Schedule::class)) {
                return $this->errorResponse('Ação não permitida');
            }
            return parent::update($id,$data);
        } catch (\Throwable $th) {
            $this->log($th->getMessage());
            return [$th->getMessage()];
        }
    }
    
    public function destroy(int $id)
    {
        try {
            if (Gate::denies('delete', Schedule::class)) {
                return $this->errorResponse('Ação não permitida');
            }
            return parent::destroy($id);
        } catch (\Throwable $th) {
            $this->log($th->getMessage());
            return [$th->getMessage()];
        }
        
    }

    public function store(array $data)
    {       
        try {
            
            $user = $data['user'];
            $user['password'] = Hash::make(uniqid());
            $user = $this->userService->storeOrUpdate($user,'findByEmail','email');
            $race = $data['race'];
            $race = $this->raceService->storeOrUpdate($race,'findByName','name');
            $animal = $data['animal'];
            $animal['owner_id'] = $user->id;
            $animal['race_id'] = $race->id;
            $animal = $this->animalService->storeAndReturnData($animal);
            $order = $data['order'];
            $order['client_id'] = $user->id;
            $order['animal_id'] = $animal->id;
            $order = $this->orderService->storeAndReturnData($order);
            $schedule = $data['schedule'];
            $schedule['order_id'] = $order->id;
            return $this->repository->store($schedule);
        } catch (\Throwable $th) {
            $this->log($th->getMessage());
            return [$th->getMessage()];
        }
    }

    public function updateSchedule(array $data)
    {
        try {
            if (Gate::denies('update', Schedule::class)) {
                return $this->errorResponse('Ação não permitida');
            }
            $schedule = $this->repository->getSpecific($data['id']);
            $doctor = $schedule->doctor;
            $order = $schedule->order;
            $client = $order->client;
            $animal = $order->animal;
            if(isset($data['animal']) and !empty($data['animal'])){
                $this->animalService->update($animal->id,$data['animal']);
            }
            if(isset($data['client']) and !empty($data['client'])){
                $this->userService->update($client->id,$data['client']);
            }
            if(isset($data['order']) and !empty($data['order'])){
                $this->orderService->update($order->id,$data['order']);
            }
            if(isset($data['doctor']['id']) and !empty($data['doctor']['id'])){
                $schedule->doctor()->detach($data['doctor']['id']);
                $schedule->doctor()->attach($data['doctor']['id']);
            }
            if(isset($data['schedule']) and !empty($data['schedule'])){
                $schedule = $this->repository->update($data['id'],$data['schedule']);
            }
            return $this->successResponse('Atualizado com sucesso');
        } catch (\Throwable $th) {
            $this->log($th->getMessage());
            return [$th->getMessage()];
        }
    }
}