<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\QuickAddCalendarUseCase;

class QuickAddCalendarController extends BaseController
{
    public function addCalendar() {
        $subject = $this->request->input->get('subject');
        $full_name = $this->request->input->get('fullName');
        $date = $this->request->input->get('date');
        $time_start = $this->request->input->get('timeStart');
        $time_end = $this->request->input->get('timeEnd');
        $doctor_id = $this->request->input->getInt('doctorId');
        $description = $this->request->input->get('description');
        $use_case = new QuickAddCalendarUseCase();
        $info = $use_case->execute($subject, $full_name, $date, $time_start, $time_end, $description, $doctor_id);
        return $this->response->json_encode(['info' => $info]);
    }
}
