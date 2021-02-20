<?php

namespace App\Http\Controllers;

use App\Repositories\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 422);
        }

        return $this->authRepository->login($request->all());

    }

    public function logout(Request $request)
    {
        $request->user()->tokens('tokenable_id', Auth::id())->delete();

        return response()->json(['message' => 'Successfully Logout'], 200);
    }

    public function getAuthUser()
    {
        return $this->authRepository->getAuthUser();
    } 
}

