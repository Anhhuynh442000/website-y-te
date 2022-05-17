<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\AddMedicineTypeUseCase;

class AddMedicineTypeController extends BaseController
{
    public function add()
    {
        $name = $this->request->input->getString('name');
        $description = $this->request->input->getString('description');
        $use_case = new AddMedicineTypeUseCase();
        $use_case->execute($name, $description);
        $this->response->redirect('/admin/medicine-type-list');
    }
}
