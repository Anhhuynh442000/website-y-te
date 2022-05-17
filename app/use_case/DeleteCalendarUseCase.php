<?php

declare(strict_types=1);

namespace App\use_case;

use App\domain\repository\AttendeesRepository;
use App\domain\repository\AttendeesRepositoryInterface;
use App\domain\repository\CalendarRepository;
use App\domain\repository\CalendarRepositoryInterface;

class DeleteCalendarUseCase
{
    private AttendeesRepositoryInterface $attendeesRepository;
    private CalendarRepositoryInterface $calendarRepository;

    public function __construct()
    {
        $this->attendeesRepository = new AttendeesRepository();
        $this->calendarRepository = new CalendarRepository();
    }

    public function execute(int $calendar_id)
    {
        $isSuccess = $this->attendeesRepository->deleteAttendeesByCalendarId($calendar_id);
        $this->calendarRepository->deleteCalendar($calendar_id);
    }
}
