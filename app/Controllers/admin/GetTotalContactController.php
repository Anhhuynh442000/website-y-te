<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\GetTotalContactUseCase;

class GetTotalContactController extends BaseController
{
    public function get()
    {
        $use_case = new GetTotalContactUseCase();
        $total = $use_case->execute();
        return $this->response->json_encode(['total' => $total]);
    }
}
