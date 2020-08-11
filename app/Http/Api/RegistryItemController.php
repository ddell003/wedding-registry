<?php


namespace App\Http\Api;


use App\Http\Requests\RegistryItemRequest;
use App\Http\Resources\DefaultResource;
use App\Services\RegistryItem\Models\RegistryItem;
use App\Services\RegistryItem\RegistryItemService;
use Response;

class RegistryItemController extends ApiController
{
    private $registryItemService;

    public function __construct(RegistryItemService $registryItemService)
    {
        $this->registryItemService = $registryItemService;
    }


    public function index()
    {
        return $this->formatResponse(DefaultResource::collection($this->registryItemService->getItems()));
    }

    public function show(RegistryItem $registryItem)
    {
        return $this->formatResponse(new DefaultResource($this->registryItemService->getItem($registryItem->id)));
    }

    public function store(RegistryItemRequest $request)
    {
        return $this->formatResponse(new DefaultResource($this->registryItemService->createItem($request->all())));
    }

    public function update(RegistryItemRequest $request, RegistryItem $registryItem)
    {
        return $this->formatResponse(new DefaultResource($this->registryItemService->updateItem($registryItem->id, $request->all())));
    }


    public function destroy(RegistryItem $registryItem)
    {
        $this->registryItemService->delete($registryItem->id);
        return Response::json([], 204);
    }
}
