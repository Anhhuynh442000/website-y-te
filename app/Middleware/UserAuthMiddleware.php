<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Core\Middleware\BaseMiddleware;
use App\Core\Response\Response;
use App\legacy\Auth;

class UserAuthMiddleware extends BaseMiddleware
{
    public function __invoke(): void
    {
        $auth = new Auth();
        if (!$auth->getAuthentication()->isLogin()) {
            $response = new Response();
            $response->redirect('/user/login');
        }
    }
}
