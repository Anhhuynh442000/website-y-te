<?php

declare(strict_types=1);

namespace App\query_services;

use App\dto\MedicineDto;

interface MedicineListQueryServiceInterface
{
    /**
     * @return MedicineDto[]|array
     */
    public function getListMedicine(int $offset): array;

    public function getTotalMedicine(): int;
}
