<?php

declare(strict_types=1);

namespace App\use_case\api;

use App\dto\PrescriptionDto;
use App\errors\Prescription as PrescriptionError;
use App\query_services\ViewPrescriptionQueryService;
use App\query_services\ViewPrescriptionQueryServiceInterface;

class GetPrescriptionApiUseCase
{
    private ViewPrescriptionQueryServiceInterface $viewPrescriptionQueryService;
    private PrescriptionError $prescriptionError;

    public function __construct()
    {
        $this->viewPrescriptionQueryService = new ViewPrescriptionQueryService();
        $this->prescriptionError = new PrescriptionError();
    }

    public function execute(int $health_id): array
    {
        $prescription = $this->viewPrescriptionQueryService->getPrescription($health_id);
        if (is_null($prescription->getId())) {
            return $this->prescriptionError->getError('PRE-0001');
        }
        return $this->createResponse($prescription);
    }

    private function createResponse(PrescriptionDto $prescription): array
    {
        return [
            'id' => $prescription->getId(),
            'name' => $prescription->getFullName(),
            'age' => $prescription->getAge(),
            'gender' => $prescription->getGender(),
            'address' => $prescription->getAddress(),
            'note' => $prescription->getNote(),
            'user_id' => $prescription->getUserId(),
            'medicine' => unserialize($prescription->getMedicineList())
        ];
    }
}
