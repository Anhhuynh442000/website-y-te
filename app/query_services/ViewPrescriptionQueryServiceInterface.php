<?php

declare(strict_types=1);

namespace App\query_services;

use App\dto\PrescriptionDto;

interface ViewPrescriptionQueryServiceInterface
{
    public function getPrescription(int $health_id): PrescriptionDto;
}
