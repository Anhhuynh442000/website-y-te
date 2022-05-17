<?php

declare(strict_types=1);

namespace App\query_services;

use App\dto\PrescriptionDto;

interface PrescriptionQueryServiceInterface
{
    public function getPrescriptionById(int $id): PrescriptionDto;
}
