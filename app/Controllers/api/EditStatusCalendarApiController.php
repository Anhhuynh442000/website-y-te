<?php

declare(strict_types=1);

namespace App\Controllers\api;

use App\Core\Controller\BaseController;
use App\use_case\api\EditStatusCalendarApiUseCase;

class EditStatusCalendarApiController extends BaseController
{
    public function edit()
    {
        $status = $this->request->input->getInt('status');
        $calendar_id = $this->request->input->getInt('calendar_id');
        $note = $this->request->input->getString('note');
        $user_id = $this->request->input->getInt('user_id');
        $use_case = new EditStatusCalendarApiUseCase();
        $response = $use_case->execute($calendar_id, $status, $note, $user_id);
        return $this->response->json_encode($response);
    }
}
