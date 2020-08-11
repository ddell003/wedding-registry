<?php


namespace App\Services\RegistryItem\Repositories;


use App\EloquentRepository;
use App\Services\RegistryItem\Models\RegistryItem;

class RegistryItemRepository extends EloquentRepository
{
    protected function getModel()
    {
        return new RegistryItem();
    }

}
