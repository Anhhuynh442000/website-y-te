<?php

declare(strict_types=1);

namespace App\domain\factory;

use App\dto\ContactDto;
use App\dto\ContactInformationForDetailDto;

class ContactDetailFactory
{
    /**
     * @var ContactDto[]
     */
    private array $contactInformation;

    /**
     * @var ContactDto[]
     */
    private array $contactReply;

    private ?ContactDto $lastContact;

    public function __construct(array $contact_information, array $contact_reply, ?ContactDto $lastContact = null)
    {
        $this->contactInformation = $contact_information;
        $this->contactReply = $contact_reply;
        $this->lastContact = $lastContact;
    }

    public function contactInformation(): array
    {
        return $this->contactInformation;
    }

    public function getContactReply(): array
    {
        return $this->contactReply;
    }

    public function getLastContact(): ContactDto
    {
        return $this->lastContact;
    }

    public function getContactForViewDetail(): ContactInformationForDetailDto
    {
        return new ContactInformationForDetailDto(
            $this->getOrderContact(),
            $this->contactInformation,
            $this->contactReply,
            $this->lastContact
        );
    }

    public function getOrderContact(): array
    {
        $temp = [];
        foreach ($this->contactInformation as $contactInfo) {
            $temp[] = $contactInfo;
            foreach ($this->contactReply as $id => $contactReply) {
                $contactId = $contactReply->getContactId();
                if ($contactInfo->getId() === $contactId) {
                    $temp[] = $this->contactReply[$id];
                }
            }
        }

        return $temp;
    }
}
