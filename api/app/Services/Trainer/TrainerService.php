<?php 

namespace App\Services\Trainer;

use App\Models\Trainer;

class TrainerService
{
    /**
     * Create a new trainer.
     *
     * @param array $data The data to create the trainer.
     * @return Trainer The created trainer instance.
     */
    public function create(array $data): Trainer
    {
        return Trainer::create($data);
    }
}