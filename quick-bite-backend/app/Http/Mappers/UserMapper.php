<?php

namespace App\Http\Mappers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserMapper
{
    public function registerRequestToUser(RegisterRequest $request): User
    {
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        return $user;
    }

}
