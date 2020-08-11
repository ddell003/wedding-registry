<?php


namespace App\Services\RegistryItem\Repositories;


use App\EloquentRepository;
use App\Services\RegistryItem\Models\RegistryItemUrl;

class RegistryItemUrlRepository extends EloquentRepository
{
    protected function getModel()
    {
        return new RegistryItemUrl();
    }

}
