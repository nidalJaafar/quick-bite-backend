<?php

namespace App\Http\Module\User\Service;

use App\Http\Module\User\Mapper\UserMapper;
use App\Http\Module\User\Request\LoginRequest;
use App\Http\Module\User\Request\RegisterRequest;
use App\Http\Module\User\Resource\TokenResource;
use App\Http\Module\User\Resource\UserCollection;
use App\Http\Module\User\Resource\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Throwable;
use function auth;

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

    public function login(LoginRequest $request): TokenResource
    {
        $user = User::where('email', $request->email)->first();
        if (!isset($user) || !Hash::check($request->password, $user->password))
            throw new ModelNotFoundException();
        return $this->createToken('login_token', $user, $request);
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
    public function signup(RegisterRequest $request): TokenResource
    {
        $user = $this->mapper->registerRequestToUser($request);
        $user->role = 'client';
        $user->saveOrFail();
        return $this->createToken('signup_token', $user, $request);
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
    public function addAdmins(RegisterRequest $request): TokenResource
    {
        $user = $this->mapper->registerRequestToUser($request);
        $user->role = 'admin';
        $user->saveOrFail();
        return $this->createToken('signup_token', $user, $request);
    }

    private function createToken($tokenName, $user, $request): TokenResource
    {
        $token = $user->createToken($tokenName)->plainTextToken;
        $request->token = $token;
        $request->user = $user;
        return new TokenResource($request);
    }

    public function getAdminUsers(): UserCollection
    {
        $admins = User::where('role', 'admin')->get();
        return new UserCollection($admins);
    }

}
