<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\EditMedicineUseCase;

class EditMedicineController extends BaseController
{
    public function editMedicine()
    {
        $id = $this->request->input->getInt('id');
        $name = $this->request->input->getString('name');
        $type_id = $this->request->input->getInt('type');
        $quantity = $this->request->input->getInt('quantity');
        $unit = $this->request->input->getString('unit');
        $description = $this->request->input->getString('description');

        $use_case = new EditMedicineUseCase();
        $use_case->execute($id, $name, $unit, $quantity, $description, $type_id);

        $this->response->redirect('/admin/medicine-detail', ['id' => $id]);
    }
}
