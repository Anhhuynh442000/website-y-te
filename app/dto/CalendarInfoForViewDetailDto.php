<?php

declare(strict_types=1);

namespace App\dto;

class CalendarInfoForViewDetailDto
{
    private CalendarForViewDto $calendar;
    private array $attendees;

    public function __construct(CalendarForViewDto $calendar, array $attendees)
    {
        $this->calendar = $calendar;
        $this->attendees = $attendees;
    }

    /**
     * @return CalendarForViewDto
     */
    public function getCalendar(): CalendarForViewDto
    {
        return $this->calendar;
    }

    /**
     * @return array
     */
    public function getAttendees(): array
    {
        return $this->attendees;
    }
}
