<?php

declare(strict_types=1);

namespace App\use_case;

use App\dto\MedicineTypeListDto;
use App\query_services\MedicineTypeQueryService;

class MedicineTypeListUseCase
{
    private MedicineTypeQueryService $medicineTypeListQueryService;

    public function __construct()
    {
        $this->medicineTypeListQueryService = new MedicineTypeQueryService();
    }

    /***
     * @return MedicineTypeListDto[]
     */
    public function execute(int $offset): array
    {
        return $this->medicineTypeListQueryService->getAllMedicineType($offset);
    }
}
