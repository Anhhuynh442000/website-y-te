<?php

declare(strict_types=1);

namespace App\domain\repository;

use App\domain\entity\MedicineType;

interface MedicineTypeRepositoryInterface
{
    public function addMedicineType(MedicineType $medicine_type): int;
}
