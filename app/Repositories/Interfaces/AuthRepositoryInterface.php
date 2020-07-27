<?php

namespace App\Repositories\Interfaces;

interface AuthRepositoryInterface
{
    public function login($request);

    public function getAuthUser();
}