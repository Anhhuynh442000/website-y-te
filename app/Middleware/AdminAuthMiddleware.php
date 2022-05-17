<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Core\Middleware\BaseMiddleware;
use App\Core\Response\Response;
use App\legacy\Auth;

class AdminAuthMiddleware extends BaseMiddleware
{
    public function __invoke(): void
    {
        $auth = new Auth();
        if (!$auth->getAuthentication()->isLogin() && ($auth->getUser()->getRole() !== 1 || $auth->getUser()->getRole(
                ) !== 2)) {
            $response = new Response();
            $response->redirect('/admin/login');
        }
    }
}
