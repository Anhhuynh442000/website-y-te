<?php

declare(strict_types=1);

namespace App\domain\entity;

class CalendarAttendees
{
    private ?int $id;
    private int $calendarId;
    private int $userId;

    public function __construct(?int $id, int $calendar_id, int $user_id)
    {
        $this->id = $id;
        $this->calendarId = $calendar_id;
        $this->userId = $user_id;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getCalendarId(): int
    {
        return $this->calendarId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}
