<?php

declare(strict_types=1);

namespace App\Controllers\user;

use App\Core\Controller\BaseController;
use App\domain\factory\CalendarForViewFactory;
use App\use_case\user\GetDoctorCalendarUseCase;

class GetDoctorCalendarController extends BaseController
{
    public function get()
    {
        $doctor_id = $this->request->input->getInt('id');
        $use_case = new GetDoctorCalendarUseCase();
        $calendar = $this->createResponseData($use_case->execute($doctor_id));
        return $this->response->json_encode($calendar);
    }

    /**
     * @param array|CalendarForViewFactory[] $calendars
     */
    private function createResponseData(array $calendars): array
    {
        $data = [];
        foreach ($calendars as $calendar) {
            $temp = [];
            $temp['id'] = $calendar->getCalendarForView()->getId();
            $temp['title'] = 'Calendar';
            $temp['start'] = $calendar->getCalendarForView()->getDateStart();
            $temp['end'] = $calendar->getCalendarForView()->getDateEnd();
            $temp['backgroundColor'] = $calendar->getCalendarForView()->getBackgroundColor();
            $temp['allDay'] = $calendar->getCalendarForView()->getStatus() === 'Reject';
            $data[] = $temp;
        }
        return $data;
    }
}
