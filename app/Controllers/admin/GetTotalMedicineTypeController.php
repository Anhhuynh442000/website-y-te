<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\GetTotalMedicineTypeUseCase;

class GetTotalMedicineTypeController extends BaseController
{
    public function get()
    {
        $use_case = new GetTotalMedicineTypeUseCase();
        $total_medicine_type = $use_case->execute();
        return $this->response->json_encode(['total' => $total_medicine_type]);
    }
}
