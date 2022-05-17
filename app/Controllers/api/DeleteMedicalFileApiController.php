<?php

declare(strict_types=1);

namespace App\Controllers\api;

use App\Core\Controller\BaseController;
use App\use_case\api\DeleteMedicalFileApiUseCase;

class DeleteMedicalFileApiController extends BaseController
{
    public function delete()
    {
        $id = $this->request->input->getInt('id');
        $use_case = new DeleteMedicalFileApiUseCase();
        $response = $use_case->execute($id);

        return $this->response->json_encode($response);
    }
}
