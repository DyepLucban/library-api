<?php

namespace App\Repositories;

use App\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{

    public function browse()
    {
        try {

            $users = User::with('role')->get();

            return response()->json($users);

        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function read($id)
    {

    }

    public function add($request)
    {
        try {

            User::create([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'role_id' => 2,
                'password' => Hash::make('password'),
            ]);

            return response()->json(['message' => 'User Successfully Created!'], 200);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit($id, $request)
    {
        try {

            $user = User::where('id', $id)->first();

            if ($user) {

                $user->first_name = $request['first_name'];
                $user->last_name = $request['last_name'];
                $user->email = $request['email'];
                $user->save();

                return response()->json(['message' => 'User Successfully Updated!'], 200);
            }

            return response()->json(['message' => 'User Not Found!'], 404);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id)
    {
        try {

            $user = User::where('id', $id)->first();

            if ($user) {

                $user->delete();

                return response()->json(['message' => 'User Successfully Deleted!'], 200);
            }

            return response()->json(['message' => 'User Not Found!'], 404);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}