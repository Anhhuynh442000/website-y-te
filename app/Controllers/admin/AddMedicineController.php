<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\AddMedicineUseCase;

class AddMedicineController extends BaseController
{
    public function addMedicine() {
        $name = $this->request->input->get('name');
        $unit = $this->request->input->get('unit');
        $quantity = $this->request->input->getInt('quantity');
        $description = $this->request->input->get('description');
        $type_id = $this->request->input->getInt('type');

        $use_case = new AddMedicineUseCase();
        $id = $use_case->execute($name, $unit, $quantity, $description, $type_id);
        if (!$id) {
            $this->response->redirect('/admin/medicine-list');
        }
        $this->response->redirect('/admin/medicine-detail', ['id' => $id]);
    }
}
