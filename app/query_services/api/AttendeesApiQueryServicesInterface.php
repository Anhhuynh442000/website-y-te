<?php

declare(strict_types=1);

namespace App\query_services\api;

use App\dto\api\AttendeesForApiDto;

interface AttendeesApiQueryServicesInterface
{
    /**
     * @param int $id
     * @return AttendeesForApiDto[]
     */
    public function findAttendeesByCalendarId(int $id): array;
}
