<?php

namespace App\Repositories\Contracts;

interface ChatRepositoryContract
{
    public function chat($authId, $userId);

    public function send($authId, $userId);
}
