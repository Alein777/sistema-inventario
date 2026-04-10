<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(
            User::with('roles')->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'rol'      => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'estado'   => 1,
        ]);

        $user->assignRole($request->rol);

        return new UserResource($user->load('roles'));
    }

    public function show(User $user)
    {
        return new UserResource($user->load('roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'sometimes|string|max:255',
            'email'    => 'sometimes|email|unique:users,email,'.$user->id,
            'password' => 'sometimes|min:6',
            'rol'      => 'sometimes|exists:roles,name',
            'estado'   => 'sometimes|integer',
        ]);

        if ($request->has('password')) {
            $request->merge(['password' => bcrypt($request->password)]);
        }

        $user->update($request->only(['name', 'email', 'password', 'estado']));

        if ($request->has('rol')) {
            $user->syncRoles($request->rol);
        }

        return new UserResource($user->load('roles'));
    }

    public function destroy(User $user)
    {
        $user->update(['estado' => 0]);
        return response()->json(['message' => 'Usuario desactivado']);
    }
}