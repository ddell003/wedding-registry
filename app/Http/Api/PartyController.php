<?php


namespace App\Http\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\PartyRequest;
use App\Http\Resources\PartyResource;
use App\Services\Party\Models\Party;
use App\Services\Party\PartyService;
use Response;

class PartyController extends ApiController
{
    private $partyService;

    public function __construct(PartyService $partyService)
    {
        $this->partyService = $partyService;
    }

    public function index()
    {
        $this->adminCheck();

        return $this->formatResponse(PartyResource::collection($this->partyService->getParties()));

    }

    public function show(Party $party)
    {
        return $this->formatResponse(new PartyResource($this->partyService->getParty($party->id)));
    }

    public function store(PartyRequest $request)
    {
        return $this->formatResponse(new PartyResource($this->partyService->createParty($request->all())));
    }

    public function update(Party $party, PartyRequest $request)
    {
        return $this->formatResponse(new PartyResource($this->partyService->updateParty($party->id, $request->all())));
    }

    public function destroy(Party $party)
    {
        $this->partyService->deleteParty($party->id);

        return Response::json([], 204);
    }
}
