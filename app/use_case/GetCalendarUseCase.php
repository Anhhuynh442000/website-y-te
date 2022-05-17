<?php

declare(strict_types=1);

namespace App\use_case;

use App\domain\factory\CalendarForViewFactory;
use App\query_services\CalendarQueryService;
use App\query_services\CalendarQueryServiceInterface;

class GetCalendarUseCase
{
    private CalendarQueryServiceInterface $calendarQueryService;

    public function __construct()
    {
        $this->calendarQueryService = new CalendarQueryService();
    }

    /**
     * @return array|CalendarForViewFactory[]
     */
    public function execute(int $login_user_id): array
    {
        return $this->calendarQueryService->getAllEventByUserId($login_user_id);
    }
}
