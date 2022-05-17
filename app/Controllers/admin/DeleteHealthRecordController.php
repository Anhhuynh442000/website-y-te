<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\DeleteHealthRecordUseCase;

class DeleteHealthRecordController extends BaseController
{
    public function deleteHealth()
    {
        $id = $this->request->input->getInt('health-id');
        $medicalFileId = $this->request->input->getInt('medical-file-id');
        $useCase = new DeleteHealthRecordUseCase();
        $useCase->execute($id);

        $this->response->redirect('/admin/medical-file-detail', ['id' => $medicalFileId]);
    }
}
