<?php

declare(strict_types=1);

namespace App\use_case;

use App\Core\Session;
use App\domain\repository\ContactRepository;

class DeleteContactUseCase
{
    private ContactRepository $contactRepository;
    private Session $session;

    public function __construct()
    {
        $this->contactRepository = new ContactRepository();
        $this->session = new Session();
    }

    public function execute(string $email): void {
        $isSuccess = $this->contactRepository->deleteContact($email);

        if (!$isSuccess) {
            $this->session->setFlash('errorDeleteContact', "Fail to delete contact with email: ${email}");
        } else {
            $this->session->setFlash('successDeleteContact', "The contact with email <b>${email}</b> is deleted");
        }
    }
}
