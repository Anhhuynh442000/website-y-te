<?php

declare(strict_types=1);

namespace App\Core\Api;

use App\Core\Auth\Authentication;

class ApiAuthentication
{
    private array $headers;

    public function authentication(): bool
    {
        $authentication = $this->headers['Medical-Authorization'] ?? '';
        if (empty($authentication)) {
            return false;
        }
        $user = base64_decode($authentication);
        $info = explode('/', $user);
        $auth = new Authentication();
        $email = $info[0] ?? '';
        $password = $info[1] ?? '';
        return $auth->login(['email' => $email, 'password' => $password]);
    }

    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }
}