<?php

declare(strict_types=1);

namespace App\use_case\api;

use App\domain\entity\Calendar;
use App\domain\factory\CalendarForViewFactory;
use App\domain\repository\CalendarRepository;
use App\domain\repository\CalendarRepositoryInterface;
use App\errors\Calendar as CalendarError;
use App\legacy\Auth;
use App\query_services\CalendarQueryService;

class EditCalendarApiUseCase
{
    private CalendarRepositoryInterface $calendarRepository;
    private CalendarError $calendarError;
    private CalendarQueryService $calendarQueryService;
    private Auth $auth;

    public function __construct()
    {
        $this->calendarRepository = new CalendarRepository();
        $this->calendarError = new CalendarError();
        $this->calendarQueryService = new CalendarQueryService();
        $this->auth = new Auth();
    }

    public function execute(
        int $calendar_id,
        string $subject,
        string $full_name,
        string $date,
        string $time_start,
        string $time_end,
        string $description,
        int $doctor_id
    ): array {
        $user_id = $this->auth->getUser()->getId();
        $calendar = $this->buildCalendar(
            $calendar_id,
            $subject,
            $full_name,
            $date,
            $time_start,
            $time_end,
            $description,
            $user_id
        );

        if (empty($full_name)) {
            return $this->calendarError->getError('CAL-0001');
        }

        if ($this->calendarRepository->getNumsCalendarByStartTimeAndEndTimeExceptCurrentCalendar($calendar) > 0) {
            return $this->calendarError->getError('CAL-0002');
        }

        if (empty($doctor_id)) {
            return $this->calendarError->getError('CAL-0003');
        }

        if (is_null($this->calendarRepository->findUserByUserIdAndRole($doctor_id, 2)->getId())) {
            return $this->calendarError->getError('CAL-0004');
        }
        $isSuccess = $this->calendarRepository->editCalendar($calendar);

        if (!$isSuccess) {
            return $this->calendarError->getError('CAL-0005');
        }

        $doctor_id_before_update = $this->getDoctorId($calendar_id);
        if ($doctor_id_before_update !== $doctor_id) {
            $successUpdateAttendees = $this->calendarRepository->updateAttendees(
                $doctor_id_before_update,
                $doctor_id,
                $calendar_id
            );
            if (!$successUpdateAttendees) {
                return $this->calendarError->getError('CAL-0006');
            }
        }
        $calendar = $this->calendarQueryService->getCalendarById($user_id, $calendar_id);
        return $this->createResponse($calendar);
    }

    private function createResponse(CalendarForViewFactory $calendar_factory): array
    {
        return [
            'id' => $calendar_factory->getCalendarForView()->getId(),
            'full_name' => $calendar_factory->getCalendarForView()->getFullName(),
            'subject' => $calendar_factory->getCalendarForView()->getSubject(),
            'date_start' => $calendar_factory->getCalendarForView()->getDateStart(),
            'date_end' => $calendar_factory->getCalendarForView()->getDateEnd(),
            'description' => $calendar_factory->getCalendarForView()->getDescription(),
            'status' => $calendar_factory->getCalendarForView()->getStatus()
        ];
    }

    private function buildCalendar(
        int $calendar_id,
        string $subject,
        string $full_name,
        string $date,
        string $time_start,
        string $time_end,
        string $description,
        int $user_id
    ): Calendar {
        return new Calendar(
            $calendar_id,
            $subject,
            $full_name,
            $date . ' ' . $time_start,
            $date . ' ' . $time_end,
            $date . ' ' . $time_start,
            $date . ' ' . $time_end,
            $description,
            $user_id
        );
    }

    private function getDoctorId(int $calendar_id): int
    {
        $attendees = $this->calendarQueryService->getAllAttendeesByCalendarId($calendar_id);
        foreach ($attendees as $attendee) {
            if ($attendee->getAttendeesForView()->getRole() === 2) {
                return $attendee->getAttendeesForView()->getId();
            }
        }
        return 0;
    }
}
