<?php

declare(strict_types=1);

namespace App\domain\factory;

use App\dto\CalendarForViewDto;

class CalendarForViewFactory
{
    private ?int $id;
    private string $subject;
    private string $timeStart;
    private string $timeEnd;
    private string $description;
    private int $status;
    private string $fullName;
    private int $userId;
    private ?int $attendeesId;
    private ?string $note;

    public function __construct(
        ?int $id,
        string $subject,
        string $full_name,
        string $time_start,
        string $time_end,
        string $description,
        int $status,
        int $user_id,
        ?int $attendees_id = null,
        ?string $note = null
    ) {
        $this->id = $id;
        $this->subject = $subject;
        $this->fullName = $full_name;
        $this->timeStart = $time_start;
        $this->timeEnd = $time_end;
        $this->description = $description;
        $this->status = $status;
        $this->userId = $user_id;
        $this->attendeesId = $attendees_id;
        $this->note = $note;
    }

    public function getCalendarForView(): CalendarForViewDto
    {
        return new CalendarForViewDto(
            $this->id,
            $this->subject,
            $this->fullName,
            $this->timeStart,
            $this->timeEnd,
            $this->description,
            $this->getStatus(),
            $this->userId,
            $this->attendeesId,
            $this->getBackgroundColor(),
            $this->note
        );
    }

    private function getStatus(): string
    {
        if ($this->status === 0) {
            return 'Pending';
        }

        if ($this->status === 1) {
            return 'Approve';
        }

        return 'Reject';
    }

    private function getBackgroundColor(): string
    {
        if ($this->status === 0) {
            return 'gray';
        }

        if ($this->status === 1) {
            return 'primary';
        }

        return 'red';
    }
}
