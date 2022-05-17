<?php

declare(strict_types=1);

namespace App\Controllers\api;

use App\Core\Controller\BaseController;
use App\use_case\api\AddCalendarApiUseCase;

class AddCalendarApiController extends BaseController
{
    public function add()
    {
        $subject = $this->request->input->get('subject');
        $full_name = $this->request->input->get('full_name');
        $date = $this->request->input->get('date');
        $time_start = $this->request->input->get('time_start');
        $time_end = $this->request->input->get('time_end');
        $doctor_id = $this->request->input->getInt('doctor_id');
        $description = $this->request->input->get('description');
        $use_case = new AddCalendarApiUseCase();
        $response = $use_case->execute($subject, $full_name, $date, $time_start, $time_end, $description, $doctor_id);
        if (array_key_exists('code', $response)) {
            $this->response->setStatusCode(500);
        } else {
            $this->response->setStatusCode(201);
        }
        return $this->response->json_encode($response);
    }
}
