<?php

declare(strict_types=1);

namespace App\use_case;

use App\dto\ContactListDto;
use App\query_services\ContactListQueryService;

class ViewContactListUseCase
{
    private ContactListQueryService $contactListQueryService;

    public function __construct()
    {
        $this->contactListQueryService = new ContactListQueryService();
    }

    public function execute(int $offset): ContactListDto
    {
        return $this->contactListQueryService->getContactForListView($offset);
    }
}
