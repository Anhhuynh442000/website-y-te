<?php

declare(strict_types=1);

namespace App\query_services;

use App\domain\factory\AttendeesForViewDetailFactory;
use App\domain\factory\CalendarForViewFactory;

interface CalendarQueryServiceInterface
{
    /**
     * @param int $user_id
     * @return array|CalendarForViewFactory[]
     */
    public function getAllEventByUserId(int $user_id): array;

    public function getCalendarById(int $user_id, int $calendar_id): CalendarForViewFactory;

    /**
     * @param int $calendar_id
     * @return array|AttendeesForViewDetailFactory[]
     */
    public function getAllAttendeesByCalendarId(int $calendar_id): array;
}
