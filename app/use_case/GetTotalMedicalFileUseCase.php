<?php

declare(strict_types=1);

namespace App\use_case;

use App\query_services\MedicalFileQueryService;

class GetTotalMedicalFileUseCase
{
    private MedicalFileQueryService $medicalFileQueryService;

    public function __construct()
    {
        $this->medicalFileQueryService = new MedicalFileQueryService();
    }

    public function execute(): int
    {
        return $this->medicalFileQueryService->getTotalMedicalFile();
    }
}
