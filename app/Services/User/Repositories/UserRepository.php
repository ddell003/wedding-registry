<?php


namespace App\Services\User\Repositories;


use App\EloquentRepository;
use App\User;

/***
 * Class UserRepository
 * @package App\Services\User\Repositories
 */
class UserRepository extends EloquentRepository
{
    protected function getModel()
    {
        return new User();
    }

}
