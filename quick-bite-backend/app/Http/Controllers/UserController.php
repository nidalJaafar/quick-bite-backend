<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Throwable;


class UserController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    public function login(Request $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        if (!isset($user) || !Hash::check($request->password, $user->password))
            throw new ModelNotFoundException();
        return response()->json(['token' => $user->createToken('login_token')->plainTextToken]);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return response()->json(status: 201);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::with('itemFeedbacks.item.images', 'visitFeedback')->get();
        return response()->json(['users' => new UserCollection($users)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function signup(Request $request): JsonResponse
    {
        $user = $this->setValues($request, new User());
        $user->save();
        return response()->json(['token' => $user->createToken('login_token')->plainTextToken], status: 201);

    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user)
    {
        $user->load('itemFeedbacks.item.images', 'visitFeedback');
        return response()->json(['user' => new UserResource($user)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(Request $request, User $user)
    {
        $this->setValues($request, $user)->saveOrFail();
        return response()->json(status: 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(User $user)
    {
        $user->deleteOrFail();
        return response()->json(status: 204);
    }

    private function setValues(Request $request, User $user): User
    {
        $this->validateRequest($request);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        return $user;
    }

    public function validateRequest(Request $request, $rules = [], $messages = [], $customAttributes = [])
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|string|unique:users,email',
            'password' => ['required', 'confirmed', 'string', Password::min(8)->letters()->symbols()->mixedCase()],
            'role' => 'required|string|in:client,admin,super admin'
        ]);
    }
}
