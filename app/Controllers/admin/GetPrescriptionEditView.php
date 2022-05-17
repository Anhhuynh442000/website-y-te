<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\dto\PrescriptionDto;
use App\Repository\MedicalFileRepository;
use App\use_case\GetPrescriptionUseCase;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GetPrescriptionEditView extends BaseController
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function get(): string
    {
        $id = $this->request->input->getInt('id');
        $medical_file_id = $this->request->input->getInt('medical-file-id');
        $use_case = new GetPrescriptionUseCase();
        $medicalRepository = new MedicalFileRepository();
        $medicines = $medicalRepository->getMedicineList();
        $prescription = $use_case->execute($id);
        $response = $this->createResponse($prescription);
        return $this->twig->render(
            'admin/pages/prescription_edit',
            ['prescriptions' => $response, 'medicines' => $medicines, 'medical_file_id' => $medical_file_id]
        );
    }

    private function createResponse(PrescriptionDto $prescription): array
    {
        return [
            'id' => $prescription->getId(),
            'full_name' => $prescription->getFullName(),
            'gender' => $prescription->getGender(),
            'age' => $prescription->getAge(),
            'address' => $prescription->getAddress(),
            'description' => $prescription->getNote(),
            'medicine_list' => unserialize($prescription->getMedicineList())
        ];
    }
}
