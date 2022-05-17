<?php

declare(strict_types=1);

namespace App\use_case;

use App\query_services\MedicineTypeQueryService;
use App\query_services\MedicineTypeQueryServiceInterface;

class GetTotalMedicineTypeUseCase
{
    private MedicineTypeQueryServiceInterface $medicineTypeQueryService;

    public function __construct()
    {
        $this->medicineTypeQueryService = new MedicineTypeQueryService();
    }

    public function execute(): int
    {
        return $this->medicineTypeQueryService->getTotalMedicineType();
    }
}
