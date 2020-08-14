<?php


namespace App\Http\Controllers;


use App\Services\Party\PartyService;

class RsvpController extends Controller
{
    private $partyService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PartyService $partyService)
    {
        $this->middleware('auth');
        $this->partyService = $partyService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //lets call the service to get the users party info
        $party = $this->partyService->getParty(\Auth::user()->party_id);
        return view('rsvp', compact('party'));
    }
}
