<?php

declare(strict_types=1);

namespace App\use_case\user;

use App\domain\factory\CalendarForViewFactory;
use App\query_services\CalendarQueryService;

class GetDoctorCalendarUseCase
{
    private CalendarQueryService $calendarQueryService;

    public function __construct()
    {
        $this->calendarQueryService = new CalendarQueryService();
    }

    /**
     * @param int $doctor_id
     * @return array|CalendarForViewFactory[]
     */
    public function execute(int $doctor_id): array
    {
        return $this->calendarQueryService->getAllCalendarDoctorByDoctorId($doctor_id);
    }
}
