<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\DeleteCalendarUseCase;

class DeleteCalendarController extends BaseController
{
    public function delete()
    {
        $id = $this->request->input->getInt('id');
        $use_case = new DeleteCalendarUseCase();
        $use_case->execute($id);
        $this->response->redirect('/admin/calendar');
    }
}
