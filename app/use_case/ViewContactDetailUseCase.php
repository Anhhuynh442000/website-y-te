<?php

declare(strict_types=1);

namespace App\use_case;

use App\domain\factory\ContactDetailFactory;
use App\query_services\ContactDetailQueryService;

class ViewContactDetailUseCase
{
    private ContactDetailQueryService $contactDetailQueryService;

    public function __construct()
    {
        $this->contactDetailQueryService = new ContactDetailQueryService();
    }

    public function execute(string $email): ContactDetailFactory
    {
        return $this->contactDetailQueryService->getContactForViewDetail($email);
    }
}
