<?php

declare(strict_types=1);

namespace App\use_case\api;

use App\query_services\api\CalendarApiQueryService;
use App\query_services\api\CalendarApiQueryServiceInterface;

class GetCalendarApiUseCase
{
    private CalendarApiQueryServiceInterface $calendarApiQueryService;

    public function __construct()
    {
        $this->calendarApiQueryService = new CalendarApiQueryService();
    }

    public function execute(int $id): array
    {
        return $this->calendarApiQueryService->getAllEventByUserId($id);
    }
}