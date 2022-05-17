<?php

declare(strict_types=1);

namespace App\domain\repository;

use App\domain\entity\Calendar;
use App\domain\entity\CalendarAttendees;
use App\domain\entity\User;

interface CalendarRepositoryInterface
{
    public function addCalendar(Calendar $calendar): int;

    public function addCalendarAttendees(CalendarAttendees $calendar_attendees): int;

    public function findUserByUserIdAndRole(int $user_id, int $role): User;

    public function editStatusCalendar(Calendar $calendar): bool;

    public function editCalendar(Calendar $calendar): bool;

    public function getNumsCalendarByStartTimeAndEndTimeExceptCurrentCalendar(Calendar $calendar): int;

    public function updateAttendees(int $old_doctor_id, int $new_doctor_id, int $calendar_id): bool;

    public function deleteCalendar(int $calendar_id): bool;
}