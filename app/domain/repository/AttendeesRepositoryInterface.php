<?php

declare(strict_types=1);

namespace App\domain\repository;

interface AttendeesRepositoryInterface
{
    public function deleteAttendeesByCalendarId(int $calendar_id): bool;
}
