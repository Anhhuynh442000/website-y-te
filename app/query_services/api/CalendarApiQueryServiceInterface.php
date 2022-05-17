<?php

declare(strict_types=1);

namespace App\query_services\api;

interface CalendarApiQueryServiceInterface
{
    public function getAllEventByUserId(int $user_id): array;
}
