<?php


namespace App\Services\Meal\Repositories;


use App\EloquentRepository;
use App\Services\Meal\Models\Meal;

class MealRepository extends EloquentRepository
{
    protected function getModel()
    {
        return new Meal();
    }
}
