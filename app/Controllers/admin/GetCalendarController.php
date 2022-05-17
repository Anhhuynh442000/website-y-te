<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\legacy\Auth;
use App\use_case\GetCalendarUseCase;
use App\domain\factory\CalendarForViewFactory;

class GetCalendarController extends BaseController
{
    public function getCalendar()
    {
        $auth = new Auth();
        $user_id = $auth->getUser()->getId();
        $user_case = new GetCalendarUseCase();
        $calendars = $user_case->execute($user_id);
        return $this->response->json_encode($this->createResponseData($calendars));
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
            $temp['title'] = $calendar->getCalendarForView()->getSubject();
            $temp['start'] = $calendar->getCalendarForView()->getDateStart();
            $temp['end'] = $calendar->getCalendarForView()->getDateEnd();
            $temp['description'] = $calendar->getCalendarForView()->getDescription();
            $temp['backgroundColor'] = $calendar->getCalendarForView()->getBackgroundColor();
            $temp['allDay'] = $calendar->getCalendarForView()->getStatus() === 'Reject';
            $data[] = $temp;
        }
        return $data;
    }
}
