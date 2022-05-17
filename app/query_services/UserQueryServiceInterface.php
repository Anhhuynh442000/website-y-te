<?php

declare(strict_types=1);

namespace App\query_services;

interface UserQueryServiceInterface
{
    public function getTotalUser(): int;
}
