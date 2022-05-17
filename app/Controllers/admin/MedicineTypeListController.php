<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\dto\MedicineTypeListDto;
use App\use_case\MedicineTypeListUseCase;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class MedicineTypeListController extends BaseController
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function getView(): string
    {
        if (!$this->request->input->has('offset')) {
            $offset = 0;
        } else {
            $offset = $this->request->input->getInt('offset');
        }

        $use_case = new MedicineTypeListUseCase();
        $medicine_types = $this->createResponse($use_case->execute($offset));
        return $this->twig->render(
            'admin/pages/medicine_type_list',
            ['medicine_types' => $medicine_types, 'total' => count($medicine_types)]
        );
    }

    /**
     * @var $medicine_types MedicineTypeListDto[]
     */
    private function createResponse(array $medicine_types): array
    {
        $data = [];
        foreach ($medicine_types as $medicine_type) {
            $temp = [];
            $temp['id'] = $medicine_type->getId();
            $temp['name'] = $medicine_type->getName();
            $data[] = $temp;
        }

        return $data;
    }
}
