<?php


namespace App\Http\Api;


use App\Http\Requests\MealRequest;
use App\Http\Resources\DefaultResource;
use App\Services\Meal\MealService;
use App\Services\Meal\Models\Meal;
use Response;

class MealController extends ApiController
{
    private $mealService;

    public function __construct(MealService $mealService)
    {
        $this->mealService = $mealService;
    }

    /**
     * Returns all non deleted meals
     * @return mixed
     */
    public function index()
    {
        return $this->formatResponse(DefaultResource::collection($this->mealService->getMeals()));
    }

    /**
     * Returns the specified meal
     * @param Meal $meal
     * @return mixed
     */
    public function show(Meal $meal)
    {
        return $this->formatResponse(new DefaultResource($this->mealService->getMeal($meal->id)));
    }

    /**
     * Create a meal
     * @param MealRequest $request
     * @return mixed
     */
    public function store(MealRequest $request)
    {
        return $this->formatResponse(new DefaultResource($this->mealService->createMeal($request->all())));
    }

    /**
     * Update a meal
     * @param MealRequest $request
     * @param Meal $meal
     * @return mixed
     */
    public function update(MealRequest $request, Meal $meal)
    {
        return $this->formatResponse(new DefaultResource($this->mealService->updateMeal($meal->id, $request->all())));
    }

    /**
     * Delete the specified meal
     * @param Meal $meal
     * @return mixed
     */
    public function destroy(Meal $meal)
    {
        $this->mealService->deleteMeal($meal->id);
        return Response::json([], 204);
    }
}
