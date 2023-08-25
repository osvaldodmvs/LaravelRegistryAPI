<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Sanctum\PersonalAccessToken;

class UserApiController extends ApiController
{
    
    public function index(Request $request)
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'profession' => 'required',
            'password' => 'required|min:8',
            'is_admin' => 'required',
        ]);
        try {
            $validated['password'] = bcrypt(Arr::get($validated, 'password'), ['rounds' => 8]);
            $validated['remember_token'] = Str::random(10);
            User::create($validated);

            return response()->json(['message' => 'User created successfully']);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'User creation failed', 'message' => $exception->getMessage()], 500);
        }
    }

    public function show(Request $request, $id)
    {
        $user=User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update($request->all());

            return response()->json(['message' => 'User updated successfully']);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['message' => 'User deleted successfully']);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

}
