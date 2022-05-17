<?php

declare(strict_types=1);

namespace App\query_services;

interface MedicineTypeQueryServiceInterface
{
    public function getAllMedicineType(int $offset): array;

    public function getTotalMedicineType(): int;
}
