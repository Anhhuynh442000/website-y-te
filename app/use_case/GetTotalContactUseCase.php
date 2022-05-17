<?php

declare(strict_types=1);

namespace App\use_case;

use App\query_services\ContactListQueryService;
use App\query_services\ContactListQueryServiceInterface;

class GetTotalContactUseCase
{
    private ContactListQueryServiceInterface $contactListQueryService;

    public function __construct()
    {
        $this->contactListQueryService = new ContactListQueryService();
    }

    public function execute(): int
    {
        return $this->contactListQueryService->getTotalContact();
    }
}
