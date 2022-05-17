<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\dto\MedicineDto;
use App\use_case\ViewMedicineDetailUseCase;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ViewMedicineDetailController extends BaseController
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function getViewMedicineDetail(): string
    {
        $id = $this->request->input->getInt('id');
        $use_case = new ViewMedicineDetailUseCase();
        $medicineDto = $use_case->execute($id);
        return $this->twig->render('admin/pages/medicine_detail', ['medicine' => $this->createResponse($medicineDto)]);
    }

    private function createResponse(MedicineDto $medicine): array
    {
        return [
            'id' => $medicine->getId(),
            'name' => $medicine->getName(),
            'type_name' => $medicine->getTypeName(),
            'unit' => $medicine->getUnit(),
            'description' => $medicine->getDescription() ?? ''
        ];
    }
}
