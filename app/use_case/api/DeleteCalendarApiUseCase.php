<?php

declare(strict_types=1);

namespace App\use_case\api;

use App\domain\repository\AttendeesRepository;
use App\domain\repository\AttendeesRepositoryInterface;
use App\domain\repository\CalendarRepository;
use App\domain\repository\CalendarRepositoryInterface;
use App\errors\Calendar as CalendarError;
use App\legacy\Auth;
use App\query_services\CalendarQueryService;
use App\query_services\CalendarQueryServiceInterface;

class DeleteCalendarApiUseCase
{
    private CalendarRepositoryInterface $calendarRepository;
    private AttendeesRepositoryInterface $attendeesRepository;
    private CalendarQueryServiceInterface $calendarQueryService;
    private Auth $auth;
    private CalendarError $calendarError;

    public function __construct()
    {
        $this->calendarRepository = new CalendarRepository();
        $this->attendeesRepository = new AttendeesRepository();
        $this->calendarQueryService = new CalendarQueryService();
        $this->calendarError = new CalendarError();
        $this->auth = new Auth();
    }

    public function execute(int $calendar_id): array
    {
        $calendar = $this->calendarQueryService->getCalendarById($this->auth->getUser()->getId(), $calendar_id);
        if (is_null($calendar->getCalendarForView()->getId())) {
            return $this->calendarError->getError('CAL-0007');
        }
        $this->attendeesRepository->deleteAttendeesByCalendarId($calendar_id);
        $this->calendarRepository->deleteCalendar($calendar_id);
        return [];
    }
}
