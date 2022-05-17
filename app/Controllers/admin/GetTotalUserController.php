<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\GetTotalUserUseCase;

class GetTotalUserController extends BaseController
{
    public function get()
    {
        $use_case = new GetTotalUserUseCase();
        $total_users = $use_case->execute();
        return $this->response->json_encode(['total' => $total_users]);
    }
}
