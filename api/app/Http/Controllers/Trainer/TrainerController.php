<?php

namespace App\Http\Controllers\Trainer;

use App\Helpers\ReturnMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Trainer\StoreRequest;
use App\Services\Trainer\TrainerService;

class TrainerController extends Controller
{
    protected $service;

    /**
     * TrainerController constructor.
     *
     * @param TrainerService $service The service instance used to handle trainer-related operations.
     */
    public function __construct(TrainerService $service)
    {
        $this->service = $service;
    }

    /**
     * Store a newly created trainer in the database.
     *
     * @param StoreRequest $request The validated request containing trainer data.
     * @return \Illuminate\Http\JsonResponse A JSON response indicating success or failure.
     *
     * @throws \Exception If an error occurs during the creation process.
     */
    public function store(StoreRequest $request)
    {
        dd('teste');
        try {
            $trainer = $this->service->create($request->validated());
            $data = $trainer->toArray();
            return ReturnMessage::success('Trainer created successfully', $data, 201);
        } catch (\Exception $e) {
            return ReturnMessage::error($e->getMessage(), [], 500);
        }
    }
}
