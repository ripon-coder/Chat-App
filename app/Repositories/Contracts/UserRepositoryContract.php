<?php

namespace App\Repositories\Contracts;

interface UserRepositoryContract
{
    public function all($authId);
}
