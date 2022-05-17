<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\AddReplyContactUseCase;

class ReplyContactController extends BaseController
{
    public function replyContact()
    {
        $contactId = $this->request->input->get('contact-id');
        $message = $this->request->input->get('message');
        $email = $this->request->input->get('email');

        $useCase = new AddReplyContactUseCase();
        $useCase->execute($contactId, $message);

        $this->response->redirect('/admin/contact-detail', ['email' => $email]);
    }
}
