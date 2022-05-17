<?php

declare(strict_types=1);

namespace App\use_case;

use App\dto\PrescriptionDto;
use App\query_services\PrescriptionQueryService;
use App\query_services\PrescriptionQueryServiceInterface;

class GetPrescriptionUseCase
{
    private PrescriptionQueryServiceInterface $prescriptionQueryService;

    public function __construct()
    {
        $this->prescriptionQueryService = new PrescriptionQueryService();
    }

    public function execute(int $id): PrescriptionDto
    {
        return $this->prescriptionQueryService->getPrescriptionById($id);
    }
}
