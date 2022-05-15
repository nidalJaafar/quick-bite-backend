<?php

namespace App\Http\Module\User\Mapper;

use App\Http\Module\User\Request\RegisterRequest;
use App\Models\User;
use function bcrypt;

class UserMapper
{
    public function registerRequestToUser(RegisterRequest $request): User
    {
        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        return $user;
    }

}
