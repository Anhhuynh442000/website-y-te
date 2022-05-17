<?php

declare(strict_types=1);

namespace App\query_services;

use App\domain\factory\ContactDetailFactory;
use App\dto\ContactDto;

interface ContactDetailQueryServiceInterface
{
    public function getContactForViewDetail(string $email): ContactDetailFactory;

    /**
     * @param string $email
     * @return ContactDto[]
     */
    public function getContactInformation(string $email): array;

    /**
     * @param string $email
     * @return ContactDto[]
     */
    public function getContactReply(string $email): array;

    public function getLastContact(string $email): ContactDto;
}
