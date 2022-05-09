<?php

namespace App\Http\Services;

use App\Http\Mappers\UserMapper;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserService
{
    private UserMapper $mapper;

    /**
     * @param UserMapper $mapper
     */
    public function __construct(UserMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function login(LoginRequest $request): string
    {
        $user = User::where('email', $request->email)->first();
        if (!isset($user) || !Hash::check($request->password, $user->password))
            throw new ModelNotFoundException();
        return $user->createToken('login_token')->plainTextToken;
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
    }

    public function getUsers(): UserCollection
    {
        $users = User::with('itemFeedbacks.item.images', 'visitFeedback')->get();
        return new UserCollection($users);
    }

    public function getUser(User $user): UserResource
    {
        $user->load('itemFeedbacks.item.images', 'visitFeedback');
        return new UserResource($user);
    }

    /**
     * @throws Throwable
     */
    public function signup(RegisterRequest $request): string
    {
        $user = $this->mapper->registerRequestToUser($request);
        $user->role = 'client';
        $user->saveOrFail();
        return $user->createToken('signup_token')->plainTextToken;
    }

    /**
     * @throws Throwable
     */
    public function updateUser(RegisterRequest $request, User $user)
    {
        $user->updateOrFail($request->all());
    }

    /**
     * @throws Throwable
     */
    public function deleteUser(User $user)
    {
        $user->deleteOrFail();
    }

    /**
     * @throws Throwable
     */
    public function addAdmins(RegisterRequest $request): string
    {
        $user = $this->mapper->registerRequestToUser($request);
        $user->role = 'admin';
        $user->saveOrFail();
        return $user->createToken('signup_token')->plainTextToken;
    }

}
