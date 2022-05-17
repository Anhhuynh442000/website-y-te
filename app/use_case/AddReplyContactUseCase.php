<?php

declare(strict_types=1);

namespace App\use_case;

use App\Core\Session;
use App\domain\entity\ContactReply;
use App\domain\repository\ContactRepository;

class AddReplyContactUseCase
{
    private ContactRepository $contactRepository;
    private Session $session;

    public function __construct()
    {
        $this->contactRepository = new ContactRepository();
        $this->session = new Session();
    }

    public function execute(string $contact_id, string $messages)
    {
        $contactReply = $this->buildContactReply($contact_id, $messages);
        $id = $this->contactRepository->replyContact($contactReply);
        if (!$id) {
            $this->session->setFlash('errorReply', 'Reply fail');
        }
    }

    public function buildContactReply(string $contact_id, string $messages): ContactReply
    {
        return new ContactReply(null, 'hieu2@mail.com', '11111', null, $messages, null, (int)$contact_id);
    }
}
