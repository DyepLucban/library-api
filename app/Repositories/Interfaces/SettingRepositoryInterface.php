<?php

namespace App\Repositories\Interfaces;

interface SettingRepositoryInterface
{
    public function browse();

    public function read($id);
    
    public function add($request);

    public function edit($id, $request);

    public function delete($id);
}