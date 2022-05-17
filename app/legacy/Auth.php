<?php

declare(strict_types=1);

namespace App\legacy;

use App\Core\Auth\Authentication;
use App\legacy\adapter\UserAuth;

class Auth
{
    private Authentication $authentication;

    public function __construct()
    {
        $this->authentication = new Authentication();
    }

    public function getAuthentication(): Authentication
    {
        return $this->authentication;
    }

    public function getUser(): UserAuth
    {
        return new UserAuth(
            (int)$this->authentication->user()->id,
            $this->authentication->user()->email,
            $this->authentication->user()->password,
            (int)$this->authentication->user()->status,
            $this->authentication->user()->token,
            (int)$this->authentication->user()->role
        );
    }
}