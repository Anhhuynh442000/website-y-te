<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\LogoutUseCase;

class LogoutController extends BaseController
{
    public function logout() {
        $use_case = new LogoutUseCase();
        $use_case->execute();
        $this->response->redirect('/admin/login');
    }
}
