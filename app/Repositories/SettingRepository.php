<?php

namespace App\Repositories;

use App\Setting;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class SettingRepository implements SettingRepositoryInterface
{

    public function browse()
    {
        try {

            $setting = Setting::all();
            return $setting;
            return response()->json($setting, 200);

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

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit($id, $request)
    {
        try {

            $data = Setting::where('id', $id)->first();

            $data->loan_days = $request['loan_days'];
            $data->color_name = $request['color_name'];
            $data->side_color = $request['color_name'] . ' lighten-1';
            $data->top_color = $request['color_name'];
            $data->save();

            return response()->json(['message' => 'Settings Updated!', 'data' => $data], 200);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id)
    {
        // try {

        //     $book = Book::where('id', $id)->first();
        
        //     if ($book) {

        //         $book->delete();

        //         return response()->json(['message' => 'Book Successfully Deleted!'], 200);
        //     }

        //     return response()->json(['message' => 'Book Not Found!'], 404);

        // } catch (\Exception $e) {
        //     return $e->getMessage();
        // }
    }
}