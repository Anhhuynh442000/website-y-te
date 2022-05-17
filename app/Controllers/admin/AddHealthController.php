<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\AddHealthUseCase;

class AddHealthController extends BaseController
{
    public function addHealth()
    {
        $input = $this->parseInput();
        $useCase = new AddHealthUseCase();
        $useCase->execute($input['summary'], [], $input['note'], $input['medical_file_id']);

        $this->response->redirect('/admin/medical-file-detail', ['id' => $input['medical_file_id']]);
    }

    private function parseInput(): array
    {
        $medicalFileId = $this->request->input->getInt('medical-file-id');
        $summary = $this->request->input->get('summary');
        $note = $this->request->input->get('note');

        return [
            'medical_file_id' => $medicalFileId,
            'summary' => $summary,
            'note' => $note,
        ];
    }
}
