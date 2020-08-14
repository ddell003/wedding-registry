<?php


namespace App\Services\Party;


use App\Obfuscator;
use App\Services\Party\Repositories\PartyRepository;
use App\Services\Party\Repositories\RsvpRepository;
use App\Services\User\Repositories\UserRepository;
use App\User;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PartyService
{

    protected $partyRepository;
    protected $userRepository;
    protected $rsvpRepository;

    private $options = [
        'includes' => [
            'users',
            'rsvp'
        ]
    ];

    /**
     * PartyService constructor.
     * dependency inject all the repositories that we will need
     * @param PartyRepository $partyRepository
     * @param UserRepository $userRepository
     */
    public function __construct(PartyRepository $partyRepository, UserRepository $userRepository, RsvpRepository $rsvpRepository)
    {
        $this->partyRepository = $partyRepository;
        $this->userRepository = $userRepository;
        $this->rsvpRepository = $rsvpRepository;
    }

    public function getParties()
    {
        return $this->partyRepository->get($this->options);
    }

    public function getUserParty(User $user)
    {
        return [];
    }

    public function getParty($partyId)
    {

        return $this->partyRepository->getById($partyId, $this->options);
    }

    public function createParty($data)
    {

        $partyData = [
            'name'=>Arr::get($data, 'name'),
            'slug'=>str_replace(' ', '_',$data['name']),
            'email'=>Arr::get($data, 'email'),
            'street'=>Arr::get($data, 'street', null),
            'street2'=>Arr::get($data, 'street2', null),
            'city'=>Arr::get($data, 'city', null),
            'state'=>Arr::get($data, 'state', null),
            'zip'=>Arr::get($data, 'zip', null),
            'country'=>Arr::get($data, 'country', 'USA'),
            'rehearsal'=>Arr::get($data, 'rehearsal', 0),
        ];


        //lets use transactions so we can role everything back on failures
        DB::beginTransaction();
        try {

            $party = $this->partyRepository->create($partyData);

            if($users = Arr::get($data, 'users')){

                foreach($users as $index=>$user){

                    //primary user gets email associated to party
                    $primary = (Arr::get($user, 'party_lead', 0) || count($users) == 1);
                    $email = $partyData['email'];
                    $userData = [
                        'name'=>Arr::get($user, 'name'),
                        'email'=>$email,
                        'party_lead'=>$primary,
                        'party_id'=>$party->id,
                        'allergies'=>Arr::get($user, 'allergies'),
                        'password' => Hash::make($partyData['slug']),
                        'api_token' => Str::random(80),
                        'meal_id'=>Arr::get($user, 'meal_id', null)
                    ];
                    if($password = Arr::get($data, 'password')){
                        $userData['password'] = bcrypt($password);
                    }

                    $this->userRepository->create($userData);
                }
            }

            if($rsvp = Arr::get($data, 'rsvp')){
                //creating
                $rsvpData = [
                    'party_id'=>$party->id,
                    'count'=>(isset($data['users'])) ? count($data['users']) : 0,
                    'attending'=>Arr::get($rsvp, 'attending', null),
                    'rehearsal'=> ($party->rehearsal) ? Arr::get($rsvp, 'rehearsal', null) : 0,
                    'ceremony'=>Arr::get($rsvp, 'ceremony', null),
                    'reception'=>Arr::get($rsvp, 'reception', null),
                    'response_may_change'=>Arr::get($rsvp, 'response_may_change', null),
                ];
                $this->rsvpRepository->create($rsvpData);
            }

            //make a unique slug that we can unhash
            $party = $this->partyRepository->update($party->id, ['slug'=>Obfuscator::encode($party->id)]);

            //if it successful commit it to the db
            DB::commit();
        }
        catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $this->getParty($party->id);
    }

    public function updateParty($partyId, $data)
    {

        $party = $this->getParty($partyId);

        $existingUsers = $party->users->pluck('name', 'id')->toArray();

        //$this->verifyU

        //dd($party->toArray());

        $partyData = [
            'name'=>Arr::get($data, 'name'),
            'email'=>Arr::get($data, 'email'),
            'street'=>Arr::get($data, 'street',  $party->street),
            'street2'=>Arr::get($data, 'street2',  $party->street2),
            'city'=>Arr::get($data, 'city',  $party->city),
            'state'=>Arr::get($data, 'state',  $party->state),
            'zip'=>Arr::get($data, 'zip',  $party->zip),
            'country'=>Arr::get($data, 'country', $party->country),
            'rehearsal'=>Arr::get($data, 'rehearsal', $party->rehearsal),
        ];


        //lets use transactions so we can role everything back on failures
        DB::beginTransaction();
        try {

            $party = $this->partyRepository->update($partyId, $partyData);

            if($users = Arr::get($data, 'users')){

                foreach($users as $index=>$user){

                    //primary user gets email associated to party
                    $primary = (Arr::get($user, 'party_lead', 0) || count($users) == 1);
                    //$email = ($primary) ? $partyData['email'] : str_replace(' ', '_',$user['name'].$party->id);
                    $email = $partyData['email'];

                    //see if user needs to be updated or created
                    if(Arr::get($user, 'id') || in_array($user['name'], $existingUsers)){

                        $userId = (Arr::get($user, 'id')) ? $user['id'] : array_flip($existingUsers)[$user['name']];
                        //update
                        $userData = [
                            'name'=>Arr::get($user, 'name'),
                            'email'=>$email,
                            'party_lead'=>$primary,
                            'party_id'=>$party->id,
                            'allergies'=>Arr::get($user, 'allergies'),
                            'meal_id'=>Arr::get($user, 'meal_id', $userId)
                        ];

                        if($password = Arr::get($data, 'password')){
                            $userData['password'] = bcrypt($password);
                        }
                        $this->userRepository->update($userId, $userData);
                    }
                    else{
                        //create
                        $userData = [
                            'name'=>Arr::get($user, 'name'),
                            'email'=>$email,
                            'party_lead'=>$primary,
                            'party_id'=>$party->id,
                            'allergies'=>Arr::get($user, 'allergies'),
                            'password' => Hash::make($party->slug),
                            'api_token' => Str::random(80),
                            'meal_id'=>Arr::get($user, 'meal_id', null)
                        ];

                        if($password = Arr::get($data, 'password')){
                            $userData['password'] = bcrypt($password);
                        }
                        $this->userRepository->create($userData);
                    }


                }
            }

            if($rsvp = Arr::get($data, 'rsvp')){
                //look to see if we are updating or creating
                if($party->rsvp){
                    //update
                    $rsvpData = [
                        'count'=>(isset($data['users'])) ? count($data['users']) : 0,
                        'attending'=>Arr::get($rsvp, 'attending', $party->rsvp->attending),
                        'rehearsal'=> ($party->rehearsal) ? Arr::get($rsvp, 'rehearsal', $party->rsvp->rehearsal) : 0,
                        'ceremony'=>Arr::get($rsvp, 'ceremony', $party->rsvp->ceremony),
                        'reception'=>Arr::get($rsvp, 'reception', $party->rsvp->reception),
                        'response_may_change'=>Arr::get($rsvp, 'response_may_change', $party->rsvp->response_may_change),
                    ];

                    $this->rsvpRepository->update($party->rsvp->id, $rsvpData);
                }
                else{
                    //creating
                    $rsvpData = [
                        'party_id'=>$partyId,
                        'count'=>(isset($data['users'])) ? count($data['users']) : 0,
                        'attending'=>Arr::get($rsvp, 'attending', null),
                        'rehearsal'=> ($party->rehearsal) ? Arr::get($rsvp, 'rehearsal', null) : 0,
                        'ceremony'=>Arr::get($rsvp, 'ceremony', null),
                        'reception'=>Arr::get($rsvp, 'reception', null),
                        'response_may_change'=>Arr::get($rsvp, 'response_may_change', null),
                    ];
                    $this->rsvpRepository->create($rsvpData);

                }
            }
            //if it successful commit it to the db
            DB::commit();
        }
        catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $this->getParty($partyId);
    }

    public function deleteParty($partyId)
    {
        $party =  $this->getParty($partyId);
        DB::beginTransaction();
        try {
            //delete rsvp
            if($party->rsvp){
                $this->rsvpRepository->delete($party->rsvp->id);
            }

            //delete party users
            if($party->users){

                foreach($party->users as $user){
                    $this->userRepository->delete($user->id);
                }
            }
            //delete party
            $this->partyRepository->delete($party->id);


            //if it successful commit it to the db
            DB::commit();
        }
        catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
