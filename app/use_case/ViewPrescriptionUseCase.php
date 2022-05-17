<?php

declare(strict_types=1);

namespace App\use_case;

use App\dto\PrescriptionDto;
use App\query_services\ViewPrescriptionQueryService;
use App\query_services\ViewPrescriptionQueryServiceInterface;

class ViewPrescriptionUseCase
{
    private ViewPrescriptionQueryServiceInterface $viewPrescriptionQueryService;

    public function __construct()
    {
        $this->viewPrescriptionQueryService = new ViewPrescriptionQueryService();
    }

    public function execute(int $health_id): PrescriptionDto
    {
        return $this->viewPrescriptionQueryService->getPrescription($health_id);
    }
}
