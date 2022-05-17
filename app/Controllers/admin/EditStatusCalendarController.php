<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\EditStatusCalendarUseCase;

class EditStatusCalendarController extends BaseController
{
    public function editStatus()
    {
        $id = $this->request->input->getInt('id');
        $status = $this->request->input->getInt('status');
        $note = $this->request->input->get('note');
        $use_case = new EditStatusCalendarUseCase();
        $use_case->execute($id, $status, $note);
        $this->response->redirect('/admin/calendar-detail', ['id' => $id]);
    }
}
