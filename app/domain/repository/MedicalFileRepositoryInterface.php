<?php

declare(strict_types=1);

namespace App\domain\repository;

use App\domain\entity\MedicalFile;

interface MedicalFileRepositoryInterface
{
    public function getMedicalFileByIdentityCard(string $identityCardId): MedicalFile;

    public function addMedicalFile(MedicalFile $medicalFile): int;

    public function updateMedicalFile(MedicalFile $medicalFile): bool;

    public function deleteMedicalFileById(int $id): bool;

    public function updateQrImageNameByMedicalFileId(int $medical_file_id, string $qr_name): bool;
}
