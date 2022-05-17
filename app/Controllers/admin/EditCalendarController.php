<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\EditCalendarUseCase;

class EditCalendarController extends BaseController
{
    public function edit()
    {
        $id = $this->request->input->getInt('id');
        $subject = $this->request->input->get('subject');
        $full_name = $this->request->input->get('full-name');
        $date = $this->request->input->get('date');
        $time_start = $this->request->input->get('time-start');
        $time_end = $this->request->input->get('time-end');
        $current_doctor_id = $this->request->input->getInt('current-doctor-id');
        $selected_doctor_id = $this->request->input->getInt('doctor-id-selected');
        $description = $this->request->input->get('description');
        $use_case = new EditCalendarUseCase();
        $use_case->execute(
            $id,
            $subject,
            $full_name,
            $date,
            $time_start,
            $time_end,
            $description,
            1,
            $current_doctor_id,
            $selected_doctor_id
        );
        $this->response->redirect('/admin/calendar-detail', ['id' => $id]);
    }
}
