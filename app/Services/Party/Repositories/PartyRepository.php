<?php


namespace App\Services\Party\Repositories;


use App\EloquentRepository;
use App\Services\Party\Models\Party;

class PartyRepository extends EloquentRepository
{
    protected function getModel()
    {
        return new Party();
    }

}
