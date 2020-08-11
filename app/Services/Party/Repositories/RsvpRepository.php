<?php


namespace App\Services\Party\Repositories;


use App\EloquentRepository;
use App\Services\Party\Models\Rsvp;

class RsvpRepository extends EloquentRepository
{
    protected function getModel()
    {
        return new Rsvp();
    }

}
