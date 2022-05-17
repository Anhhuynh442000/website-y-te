<?php

declare(strict_types=1);

namespace App\use_case;

use App\legacy\Auth;

class LogoutUseCase
{
    private Auth $auth;

    public function __construct()
    {
        $this->auth = new Auth();
    }

    public function execute() {
        $this->auth->getAuthentication()->logout();
    }
}
