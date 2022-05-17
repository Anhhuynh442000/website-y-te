<?php

declare(strict_types=1);

namespace App\use_case\api;

use App\dto\api\AttendeesForApiDto;
use App\query_services\api\AttendeesApiQueryServices;

class GetAttendeesUseCase
{
    private AttendeesApiQueryServices $attendeesApiQueryService;

    public function __construct()
    {
        $this->attendeesApiQueryService = new AttendeesApiQueryServices();
    }

    /**
     * @param int $id
     * @return AttendeesForApiDto[]
     */
    public function execute(int $id): array
    {
        if (!$id) {
            return [];
        }
        return $this->attendeesApiQueryService->findAttendeesByCalendarId($id);
    }
}
