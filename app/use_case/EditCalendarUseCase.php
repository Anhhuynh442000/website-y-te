<?php

declare(strict_types=1);

namespace App\use_case;

use App\Core\Session;
use App\domain\entity\Calendar;
use App\domain\repository\CalendarRepository;
use App\domain\repository\CalendarRepositoryInterface;

class EditCalendarUseCase
{
    private CalendarRepositoryInterface $calendarRepository;
    private Session $session;

    public function __construct()
    {
        $this->calendarRepository = new CalendarRepository();
        $this->session = new Session();
    }

    public function execute(
        int $calendar_id,
        string $subject,
        string $full_name,
        string $date,
        string $time_start,
        string $time_end,
        string $description,
        int $user_id,
        int $current_doctor_id,
        int $selected_doctor_id
    ): bool {
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
        if ($this->calendarRepository->getNumsCalendarByStartTimeAndEndTimeExceptCurrentCalendar($calendar) > 0) {
            $this->session->setFlash('errorEditCalendar', 'Calendar is conflicted!');
            return false;
        }

        if (empty($current_doctor_id)) {
            $this->session->setFlash('errorEditCalendar', 'Please choose a doctor!');
            return false;
        }

        if (is_null($this->calendarRepository->findUserByUserIdAndRole($selected_doctor_id, 2)->getId())) {
            $this->session->setFlash('errorEditCalendar', 'Doctor is chosen not valid!');
            return false;
        }
        $isSuccess = $this->calendarRepository->editCalendar($calendar);

        if (!$isSuccess) {
            $this->session->setFlash('errorEditCalendar', 'Update calendar fail!');
            return false;
        }

        if ($current_doctor_id !== $selected_doctor_id) {
            $successUpdateAttendees = $this->calendarRepository->updateAttendees($selected_doctor_id, $current_doctor_id, $calendar_id);
            if (!$successUpdateAttendees) {
                $this->session->setFlash('errorEditCalendar', 'Update attendees fail!');
                return false;
            }
        }
        $this->session->setFlash('successEditCalendar', 'Update calendar fail!');
        return true;
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
}
