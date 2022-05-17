<?php

declare(strict_types=1);

namespace App\dto;

class MedicineForListViewDto
{
    /**
     * @var MedicineDto[]
     */
    private array $medicine;
    /**
     * @var MedicineTypeListDto[]
     */
    private array $medicineTypeList;

    public function __construct(array $medicine, array $medicine_type_list)
    {
        $this->medicine = $medicine;
        $this->medicineTypeList = $medicine_type_list;
    }

    /**
     * @return MedicineDto[]
     */
    public function getMedicine(): array
    {
        return $this->medicine;
    }

    /**
     * @return MedicineTypeListDto[]
     */
    public function getMedicineTypeList(): array
    {
        return $this->medicineTypeList;
    }
}
