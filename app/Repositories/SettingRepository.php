<?php

namespace App\Repositories;

class SettingRepository 
{

    public function __construct($setting)
    {
        $this->setting = $setting;
    }

    public function browse()
    {
        try {

            $setting = $this->setting->all();
            return $setting;
            return response()->json($setting, 200);

        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function read($id)
    {
        //
    }

    public function add($request)
    {
        //
    }

    public function edit($id, $request)
    {
        try {

            $data = $this->setting->where('id', $id)->first();

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
        //
    }
}