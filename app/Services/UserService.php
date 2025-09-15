<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryContract;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers($authId, $requestData = [])
    {
        $query = $this->userRepository->all($authId, $requestData);

        return $query->paginate(10)->withQueryString();

    }
}
