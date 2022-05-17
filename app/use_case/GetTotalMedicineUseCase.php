<?php

declare(strict_types=1);

namespace App\use_case;

use App\query_services\MedicineListQueryService;
use App\query_services\MedicineListQueryServiceInterface;

class GetTotalMedicineUseCase
{
    private MedicineListQueryServiceInterface $medicineListQueryService;

    public function __construct()
    {
        $this->medicineListQueryService = new MedicineListQueryService();
    }

    public function execute(): int
    {
        return $this->medicineListQueryService->getTotalMedicine();
    }
}
