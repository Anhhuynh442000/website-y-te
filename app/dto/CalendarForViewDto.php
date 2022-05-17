<?php

declare(strict_types=1);

namespace App\dto;

class CalendarForViewDto
{
    private ?int $id;
    private string $subject;
    private string $dateStart;
    private string $dateEnd;
    private string $status;
    private string $description;
    private ?string $backgroundColor;
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
        string $status,
        int $user_id,
        ?int $attendees_id = null,
        ?string $background_color = null,
        ?string $note = null
    ) {
        $this->id = $id;
        $this->subject = $subject;
        $this->fullName = $full_name;
        $this->dateStart = $time_start;
        $this->dateEnd = $time_end;
        $this->description = $description;
        $this->status = $status;
        $this->userId = $user_id;
        $this->attendeesId = $attendees_id;
        $this->backgroundColor = $background_color;
        $this->note = $note;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @return string
     */
    public function getDateStart(): string
    {
        return $this->dateStart;
    }

    /**
     * @return string
     */
    public function getDateEnd(): string
    {
        return $this->dateEnd;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return ?int
     */
    public function getAttendeesId(): ?int
    {
        return $this->attendeesId;
    }

    /**
     * @return string|null
     */
    public function getBackgroundColor(): ?string
    {
        return $this->backgroundColor;
    }

    /**
     * @return string|null
     */
    public function getNote(): ?string
    {
        return $this->note;
    }
}
