<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\GetTotalMedicineUseCase;

class GetTotalMedicineController extends BaseController
{
    public function get()
    {
        $use_case = new GetTotalMedicineUseCase();
        $total_medicines = $use_case->execute();
        return $this->response->json_encode(['total' => $total_medicines]);
    }
}
