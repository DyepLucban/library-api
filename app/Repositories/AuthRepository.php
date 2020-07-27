<?php

namespace App\Repositories;

use App\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthRepository implements AuthRepositoryInterface
{

    public function login($request)
    {
        try {

            $user = User::where('email', $request['email'])->first();

            if (!$user || !Hash::check($request['password'], $user->password))
            {
                return response()->json(['message' => 'Invalid Credentials'], 401);
            }

            
            $token = $user->createToken($request['device_name'])->plainTextToken;

            return response()->json(['token' => $token, 'role' => $user->role_id], 200);

        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function getAuthUser()
    {
        try {

            $user = Auth::user();

            return response()->json($user, 200); 

        } catch (\Exception $e) {
            return $e->getMessage();
        }    
    }


}