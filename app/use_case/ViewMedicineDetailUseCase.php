<?php

declare(strict_types=1);

namespace App\use_case;

use App\dto\MedicineDto;
use App\query_services\MedicineDetailQueryService;
use App\query_services\MedicineDetailQueryServiceInterface;

class ViewMedicineDetailUseCase
{
    private MedicineDetailQueryServiceInterface $medicineDetailQueryService;

    public function __construct()
    {
        $this->medicineDetailQueryService = new MedicineDetailQueryService();
    }

    public function execute(int $id): MedicineDto
    {
        return $this->medicineDetailQueryService->getMedicineDetailById($id);
    }
}
