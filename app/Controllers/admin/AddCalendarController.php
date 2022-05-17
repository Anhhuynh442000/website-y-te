<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\AddCalendarUseCase;

class AddCalendarController extends BaseController
{
    public function add()
    {
        $subject = $this->request->input->get('subject');
        $full_name = $this->request->input->get('full-name');
        $date = $this->request->input->get('date');
        $time_start = $this->request->input->get('time-start');
        $time_end = $this->request->input->get('time-end');
        $doctor_id = $this->request->input->getInt('doctor-id');
        $description = $this->request->input->get('description');
        $use_case = new AddCalendarUseCase();
        $id = $use_case->execute($subject, $full_name, $date, $time_start, $time_end, $description, $doctor_id);
        if (!$id) {
            $this->response->redirect('/admin/calendar-add');
        }
        $this->response->redirect('/admin/calendar-detail', ['id' => $id]);
    }
}
