<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\DeleteContactUseCase;

class DeleteContactController extends BaseController
{
    public function deleteContact() {
        $email = $this->request->input->getString('email');
        $useCase = new DeleteContactUseCase();
        $useCase->execute($email);

        $this->response->redirect('/admin/contact-list');
    }
}
