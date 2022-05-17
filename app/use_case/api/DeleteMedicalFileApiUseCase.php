<?php

declare(strict_types=1);

namespace App\use_case\api;

use App\domain\repository\MedicalFileRepository;
use App\domain\repository\MedicalFileRepositoryInterface;
use App\errors\MedicalFile as MedicalFileError;

class DeleteMedicalFileApiUseCase
{
    private MedicalFileRepositoryInterface $medicalFileRepository;
    private MedicalFileError $medicalFileError;

    public function __construct()
    {
        $this->medicalFileRepository = new MedicalFileRepository();
        $this->medicalFileError = new MedicalFileError();
    }

    public function execute(int $id): array
    {
        $is_delete_success = $this->medicalFileRepository->deleteMedicalFileById($id);
        if (!$is_delete_success) {
            return $this->medicalFileError->getError('MED-0007');
        }
        return [];
    }
}
