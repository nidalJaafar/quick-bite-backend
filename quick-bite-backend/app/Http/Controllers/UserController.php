<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function login(Request $request): JsonResponse
    {
        //validate
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
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $this->setValues($request, new User())->save();
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
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $this->setValues($request, User::findOrFail($id))->save();
        return response()->json(status: 204);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $user = User::with(['itemFeedbacks.item', 'visitFeedback'])->findOrFail($id);
        return response()->json(['user' => new UserResource($user)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        User::findOrFail($id)->destroy($id);
        return response()->json(status: 204);
    }

    private function setValues(Request $request, User $user): User
    {
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        return $user;
    }
}
