<?php

declare(strict_types=1);

namespace App\use_case;

use App\query_services\UserQueryService;
use App\query_services\UserQueryServiceInterface;

class GetTotalUserUseCase
{
    private UserQueryServiceInterface $userQueryService;

    public function __construct()
    {
        $this->userQueryService = new UserQueryService();
    }

    public function execute(): int
    {
        return $this->userQueryService->getTotalUser();
    }
}
