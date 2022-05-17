<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\dto\PrescriptionDto;
use App\use_case\ViewPrescriptionUseCase;

class ViewPrescriptionController extends BaseController
{
    public function getPrescription()
    {
        $healthId = $this->request->input->getInt('id');
        $useCase = new ViewPrescriptionUseCase();
        $prescriptionDto = $useCase->execute($healthId);
        return $this->response->json_encode($this->createResponseData($prescriptionDto));
    }

    private function createResponseData(PrescriptionDto $prescriptionDto): array
    {
        return [
            'id' => $prescriptionDto->getId(),
            'fullName' => $prescriptionDto->getFullName(),
            'gender' => $prescriptionDto->getGender() ?? '',
            'age' => $prescriptionDto->getAge(),
            'address' => $prescriptionDto->getAddress(),
            'note' => $prescriptionDto->getNote(),
            'medicineList' => unserialize($prescriptionDto->getMedicineList())
        ];
    }
}
