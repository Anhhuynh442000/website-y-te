<?php

declare(strict_types=1);

namespace App\use_case\api;

use App\domain\entity\Calendar;
use App\errors\Calendar as CalendarError;
use App\domain\entity\CalendarAttendees;
use App\domain\repository\CalendarRepository;
use App\domain\repository\CalendarRepositoryInterface;
use App\legacy\Auth;

class AddCalendarApiUseCase
{
    const DEFAULT_STATUS = 0;

    private CalendarRepositoryInterface $calendarRepository;
    private Auth $auth;
    private CalendarError $calendarError;

    public function __construct()
    {
        $this->calendarRepository = new CalendarRepository();
        $this->auth = new Auth();
        $this->calendarError = new CalendarError();
    }

    /**
     * @param string $subject
     * @param string $full_name
     * @param string $date
     * @param string $time_start
     * @param string $time_end
     * @param string $description
     * @param int $doctor_id
     * @return string[]
     */
    public function execute(
        string $subject,
        string $full_name,
        string $date,
        string $time_start,
        string $time_end,
        string $description,
        int $doctor_id
    ): array {
        $calendar = $this->buildCalendar(
            $subject,
            $full_name,
            $date,
            $time_start,
            $time_end,
            $description,
            $this->auth->getUser()->getId()
        );
        if (empty($full_name)) {
            return $this->calendarError->getError('CAL-0001');
        }

        if ($this->calendarRepository->getNumsCalendarByStartTimeAndEndTime($calendar) > 0) {
            return $this->calendarError->getError('CAL-0002');
        }

        if (empty($doctor_id)) {
            return $this->calendarError->getError('CAL-0003');
        }

        if (is_null($this->calendarRepository->findUserByUserIdAndRole($doctor_id, 2)->getId())) {
            return $this->calendarError->getError('CAL-0004');
        }

        $calendar_id = $this->calendarRepository->addCalendar($calendar);
        if (!$calendar_id) {
            return $this->calendarError->getError('CAL-0005');
        }

        $user_created = $this->buildCalendarAttendees($calendar_id, 1);
        $user_attendees = $this->buildCalendarAttendees($calendar_id, $doctor_id);
        $this->calendarRepository->addCalendarAttendees($user_created);
        $this->calendarRepository->addCalendarAttendees($user_attendees);

        return ['id' => $calendar_id];
    }

    private function buildCalendar(
        string $subject,
        string $full_name,
        string $date,
        string $time_start,
        string $time_end,
        string $description,
        int $user_id
    ): Calendar {
        return new Calendar(
            null,
            $subject,
            $full_name,
            $date . ' ' . $time_start,
            $date . ' ' . $time_end,
            $date . ' ' . $time_start,
            $date . ' ' . $time_end,
            $description,
            $user_id,
            self::DEFAULT_STATUS
        );
    }

    private function buildCalendarAttendees(int $calendar_id, int $user_id): CalendarAttendees
    {
        return new CalendarAttendees(null, $calendar_id, $user_id);
    }
}
