<?php

declare(strict_types=1);

namespace App\domain\repository;

use App\domain\entity\Prescription;

interface PrescriptionRepositoryInterface
{
    public function addPrescription(Prescription $prescription): int;

    public function editPrescription(Prescription $prescription): bool;
}
