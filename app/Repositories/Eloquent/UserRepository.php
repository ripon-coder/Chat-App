<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Services\UserFilter;

class UserRepository implements UserRepositoryContract
{
    protected $userFilter;

    public function __construct(UserFilter $userFilter)
    {
        $this->userFilter = $userFilter;
    }

    public function all($authId, $filterData = [])
    {
        $query = User::with('media')->whereNot('id', $authId)->orderByDesc('id');
        $query = $this->userFilter->getResults([
            'query' => $query,
            'filter' => $filterData,
        ]);

        return $query;
    }
}
