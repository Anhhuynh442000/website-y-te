<?php

declare(strict_types=1);

namespace App\dto;

class ContactListDto
{
    /**
     * @var ContactListDto[]
     */
    private array $contactListDto;

    /**
     * @param ContactListDto[] $contactListDto
     */
    public function __construct(array $contactListDto)
    {
        $this->contactListDto = $contactListDto;
    }

    /**
     * @return ContactDto[]
     */
    public function getContactListDto(): array
    {
        return $this->contactListDto;
    }
}
