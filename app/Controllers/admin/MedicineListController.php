<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\dto\MedicineForListViewDto;
use App\use_case\ViewMedicineListUseCase;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class MedicineListController extends BaseController
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function getViewMedicineList(): string
    {
        if ($this->request->input->has('offset')) {
            $offset = $this->request->input->getInt('offset');
        } else {
            $offset = 0;
        }

        $use_case = new ViewMedicineListUseCase();
        $medicine_for_view = $this->createResponse($use_case->execute($offset));
        return $this->twig->render(
            'admin/pages/medicine_list',
            ['medicine_for_view' => $medicine_for_view, 'total' => count($medicine_for_view['medicines'])]
        );
    }

    private function createResponse(MedicineForListViewDto $medicines_list): array
    {
        $medicines = [];
        foreach ($medicines_list->getMedicine() as $medicine) {
            $temp = [];
            $temp['id'] = $medicine->getId();
            $temp['name'] = $medicine->getName();
            $temp['type_name'] = $medicine->getTypeName();
            $medicines[] = $temp;
        }

        $medicine_types = [];
        foreach ($medicines_list->getMedicineTypeList() as $medicine_type) {
            $temp = [];
            $temp['id'] = $medicine_type->getId();
            $temp['name'] = $medicine_type->getName();
            $medicine_types[] = $temp;
        }

        return ['medicines' => $medicines, 'medicine_types' => $medicine_types];
    }
}
