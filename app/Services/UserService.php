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

    public function getAllUsers($authId)
    {
        return $users = $this->userRepository->all($authId);

    }
}
