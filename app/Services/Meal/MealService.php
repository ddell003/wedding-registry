<?php


namespace App\Services\Meal;

use App\Services\Meal\Repositories\MealRepository;

/**
 * Class MealService
 * All the business logic pertaining to meals, interacts with the data base through repository layer
 * @package App\Services\Meal
 */
class MealService
{
    private $mealRepository;

    public function __construct(MealRepository $mealRepository)
    {
        $this->mealRepository =$mealRepository;
    }

    public function getMeal($mealId)
    {
        return $this->mealRepository->getById($mealId);
    }

    public function getMeals()
    {
        return $this->mealRepository->get();
    }

    public function createMeal($data)
    {
        //only admins can create a meal
        $this->adminCheck();
        return $this->mealRepository->create($data);
    }

    public function updateMeal($mealId, $data)
    {
        //only admins can update a meal
        $this->adminCheck();
        return $this->mealRepository->update($mealId, $data);
    }
    public function deleteMeal($mealId)
    {
        //only admins can delete a meal
        $this->adminCheck();
        return $this->mealRepository->delete($mealId);
    }

    protected function adminCheck()
    {
        if(Auth()->user()->admin != 1){
            redirect(403);
        }
    }
}
