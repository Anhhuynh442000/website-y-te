<?php

declare(strict_types=1);

namespace App\domain\repository;

use App\domain\entity\Medicine;

interface MedicineRepositoryInterface
{
    public function addMedicine(Medicine $medicine): int;

    public function updateMedicine(Medicine $medicine): bool;
}
