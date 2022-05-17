<?php

declare(strict_types=1);

namespace App\query_services;

use App\dto\HealthDto;

interface HealthQueryServiceInterface
{
    /**
     * @param int $medical_file_id
     * @return HealthDto[]
     */
    public function getHealthByMedicalFileId(int $medical_file_id): array;
}
