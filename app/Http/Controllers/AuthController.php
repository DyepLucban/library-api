<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
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

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'required|min:8',
            'password_retype' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 422);
        }

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role_id' => (int)$request->input('role'),
            'password' => Hash::make($request->input('password')),
        ]);

        return response()->json(['message' => 'User Successfully Created!'], 200);
    }

    public function getAuthUser()
    {
        return $this->authRepository->getAuthUser();
    } 
}

