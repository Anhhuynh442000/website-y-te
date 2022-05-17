<?php

declare(strict_types=1);

namespace App\domain\repository;

use App\domain\entity\HealthInsurance;

interface HealthInsuranceRepositoryInterface
{
    public function addHealthInsurance(HealthInsurance $health_insurance): int;
}
