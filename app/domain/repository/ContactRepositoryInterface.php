<?php

namespace App\domain\repository;

use App\domain\entity\ContactReply;

interface ContactRepositoryInterface
{
    public function replyContact(ContactReply $contact): int;

    public function deleteContact(string $email): bool;
}
