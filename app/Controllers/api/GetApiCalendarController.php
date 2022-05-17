<?php

declare(strict_types=1);

namespace App\Controllers\api;

use App\Core\Controller\BaseController;
use App\domain\factory\CalendarForViewFactory;
use App\legacy\Auth;
use App\use_case\api\GetCalendarApiUseCase;

class GetApiCalendarController extends BaseController
{
    public function getCalendar() {
        $use_case = new GetCalendarApiUseCase();
        $calendars = $use_case->execute($this->parseInput());
        return $this->response->json_encode($this->createResponse($calendars));
    }

    /**
     * @param CalendarForViewFactory[] $calendars
     */
    private function createResponse(array $calendars): array {
        $data = [];
        foreach ($calendars as $calendar_factory) {
            $temp = [];
            $temp['id'] = $calendar_factory->getCalendarForView()->getId();
            $temp['subject'] = $calendar_factory->getCalendarForView()->getSubject();
            $temp['full_name'] = $calendar_factory->getCalendarForView()->getFullName();
            $temp['date_start'] = $calendar_factory->getCalendarForView()->getDateStart();
            $temp['date_end'] = $calendar_factory->getCalendarForView()->getDateEnd();
            $temp['description'] = $calendar_factory->getCalendarForView()->getDescription();
            $temp['status'] = $calendar_factory->getCalendarForView()->getStatus();
            $data[] = $temp;
        }
        return $data;
    }

    private function parseInput(): int {
        $auth = new Auth();
        return $auth->getUser()->getId();
    }
}
