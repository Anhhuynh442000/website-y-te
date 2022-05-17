<?php

declare(strict_types=1);

namespace App\use_case;

use App\dto\MedicineForListViewDto;
use App\query_services\MedicineListQueryService;
use App\query_services\MedicineListQueryServiceInterface;
use App\query_services\MedicineTypeQueryService;
use App\query_services\MedicineTypeQueryServiceInterface;

class ViewMedicineListUseCase
{
    private MedicineListQueryServiceInterface $medicineQueryService;
    private MedicineTypeQueryServiceInterface $medicineTypeQueryService;

    public function __construct()
    {
        $this->medicineQueryService = new MedicineListQueryService();
        $this->medicineTypeQueryService = new MedicineTypeQueryService();
    }

    /**
     * @param int $offset
     * @return MedicineForListViewDto
     */
    public function execute(int $offset): MedicineForListViewDto
    {
        $medicine_list = $this->medicineQueryService->getListMedicine($offset);
        $medicine_type_list = $this->medicineTypeQueryService->getAllMedicineType();
        return new MedicineForListViewDto($medicine_list, $medicine_type_list);
    }
}
