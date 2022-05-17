<?php

declare(strict_types=1);

namespace App\Controllers\api;

use App\Core\Controller\BaseController;
use App\use_case\api\GetPrescriptionApiUseCase;

class GetPrescriptionApiController extends BaseController
{
    public function get()
    {
        $id = $this->request->input->getInt('id');
        $use_case = new GetPrescriptionApiUseCase();
        $response = $use_case->execute($id);
        return $this->response->json_encode($response);
    }
}
