<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\DeleteMedicalFileUseCase;

class DeleteMedicalFileController extends BaseController
{
    public function delete() {
        $id = $this->request->input->getInt('medical-file-id');
        $use_case = new DeleteMedicalFileUseCase();
        $use_case->execute($id);
        $this->response->redirect('/admin/medical-file-list');
    }
}
