<?php

declare(strict_types=1);

namespace App\use_case;

use App\Core\Session;
use App\domain\repository\MedicalFileRepository;
use App\domain\repository\MedicalFileRepositoryInterface;

class DeleteMedicalFileUseCase
{
    private MedicalFileRepositoryInterface $medicalFileRepository;
    private Session $session;

    public function __construct()
    {
        $this->medicalFileRepository = new MedicalFileRepository();
        $this->session = new Session();
    }

    public function execute(int $id): bool {
        $isSuccess = $this->medicalFileRepository->deleteMedicalFileById($id);
        if (!$isSuccess) {
            $this->session->setFlash('errorDeleteMedicalFile', 'Delete medical file fail');
            return false;
        }
        $this->session->setFlash('successDeleteMedicalFile', 'Delete medical file success');
        return true;
    }
}
