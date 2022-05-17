<?php

declare(strict_types=1);

namespace App\dto;

class ContactInformationForDetailDto
{
    /**
     * @var ContactDto[]
     */
    private array $contactInformationList;
    private array $contactInformation;
    private array $contactReply;
    private ?ContactDto $lastContact;

    /**
     * @param ContactDto[] $contactInformationList
     */
    public function __construct(
        array $contactInformationList,
        array $contactInformation,
        array $contactReply,
        ?ContactDto $lastContact
    ) {
        $this->contactInformationList = $contactInformationList;
        $this->contactInformation = $contactInformation;
        $this->contactReply = $contactReply;
        $this->lastContact = $lastContact;
    }

    /**
     * @return ContactDto[]
     */
    public function getContactInformationList(): array
    {
        return $this->contactInformationList;
    }

    public function getContactInformation(): array
    {
        return $this->contactInformation;
    }

    public function getContactReply(): array
    {
        return $this->contactReply;
    }

    public function getLastContact(): ?ContactDto
    {
        return $this->lastContact;
    }
}
