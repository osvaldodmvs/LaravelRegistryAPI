<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;


class LoginApiController extends ApiController
{
    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            $user = Auth::user();

            $users = PersonalAccessToken::all();
            foreach ($users as $usercheck) {
                if($usercheck->tokenable_id == $user->id){
                    return $this->errorResponse('You are already logged in.', 401);
                }
            }
            foreach ($user->tokens as $token) {
                $token->delete();
            }

            $token = $user->createToken('api-token')->plainTextToken;

            return $this->successResponse([
                'user' => $user,
                'token' => $token,
                'attention' => "save this token, you will not be able to see it again (use without ID| prefix)",
            ]);
        } else {
            return $this->errorResponse('Email address or password are wrong.', 401);
        }
    }

    public function logout(Request $request)
    {

        $bearerToken = $request->bearerToken();

        if (!$bearerToken) {
            return $this->errorResponse('You are not logged in.', 401);
        }

        $hashed=hash('sha256', $bearerToken);
        $found = PersonalAccessToken::where('token', $hashed)->first();
        if (!$found) {
            return $this->errorResponse('No such token.', 401);
        }
        $found->delete();
        return $this->successResponse('Logged out successfully.');
    }


}