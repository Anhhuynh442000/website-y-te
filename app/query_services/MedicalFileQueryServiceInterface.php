<?php

declare(strict_types=1);

namespace App\query_services;

use App\dto\api\MedicalFileForApiDto;

interface MedicalFileQueryServiceInterface
{
    public function getMedicalFile($id): MedicalFileForApiDto;

    public function getMedicalFileForSearch(string $key_word): array;

    public function getTotalMedicalFile(): int;
}
