<?php

declare(strict_types=1);

namespace App\query_services;

use App\dto\MedicineDto;

interface MedicineDetailQueryServiceInterface
{
    public function getMedicineDetailById(int $id): MedicineDto;
}
