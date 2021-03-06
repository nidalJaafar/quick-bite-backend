<?php

namespace App\Http\Module\User\Controller;

use App\Http\Controllers\Controller;
use App\Http\Module\User\Request\LoginRequest;
use App\Http\Module\User\Request\RegisterRequest;
use App\Http\Module\User\Service\UserService;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Throwable;
use function response;


class UserController extends Controller
{

    private UserService $service;

    /**
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }


    public function login(LoginRequest $request): JsonResponse
    {
        return response()->json($this->service->login($request));
    }

    public function logout(): JsonResponse
    {
        $this->service->logout();
        return response()->json(status: 201);
    }

    /**
     * @throws AuthorizationException
     * @throws Throwable
     */
    public function store(RegisterRequest $request): JsonResponse
    {
        $this->authorize('createAdmin', User::class);
        return response()->json($this->service->addAdmins($request), status: 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function signup(RegisterRequest $request): JsonResponse
    {
        return response()->json($this->service->signup($request), status: 201);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', User::class);
        return response()->json(['users' => $this->service->getUsers()]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function indexAdmins(): JsonResponse
    {
        $this->authorize('viewAny', User::class);
        return response()->json(['users' => $this->service->getAdminUsers()]);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(User $user): JsonResponse
    {
        $this->authorize('view', $user);
        return response()->json(['user' => $this->service->getUser($user)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RegisterRequest $request
     * @param User $user
     * @return JsonResponse
     * @throws AuthorizationException|Throwable
     */
    public function update(RegisterRequest $request, User $user): JsonResponse
    {
        $this->authorize('update', $user);
        $this->service->updateUser($request, $user);
        return response()->json(status: 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(User $user): JsonResponse
    {
        $this->authorize('delete', $user);
        $this->service->deleteUser($user);
        return response()->json(status: 204);
    }

}
