<?php

declare(strict_types=1);

namespace App\Controllers\api;

use App\Core\Controller\BaseController;
use App\use_case\api\GetMedicalFileApiUseCase;

class GetMedicalFileApiController extends BaseController
{
    public function get()
    {
        $id = $this->request->input->getInt('id');
        $use_case = new GetMedicalFileApiUseCase();
        return $this->response->json_encode($use_case->execute($id));
    }
}
