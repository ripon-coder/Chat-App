<?php 
namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;

class UserRepository implements UserRepositoryContract
{
    public function all($authId)
    {
        return User::whereNot("id",$authId)->orderByDesc("id")->get();
    }
}