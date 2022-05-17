<?php

declare(strict_types=1);

namespace App\domain\entity;

class Calendar
{
    private ?int $id;
    private string $subject;
    private string $timeStart;
    private string $dateStart;
    private string $timeEnd;
    private string $description;
    private int $userId;
    private string $fullName;
    private string $dateEnd;
    private ?int $status;
    private ?string $note;

    public function __construct(
        ?int $id,
        string $subject,
        string $full_name,
        string $date_start,
        string $date_end,
        string $time_start,
        string $time_end,
        string $description,
        int $user_id,
        ?int $status = null,
        ?string $note = null
    ) {
        $this->id = $id;
        $this->subject = $subject;
        $this->fullName = $full_name;
        $this->dateStart = $date_start;
        $this->dateEnd = $date_end;
        $this->timeStart = $time_start;
        $this->timeEnd = $time_end;
        $this->description = $description;
        $this->userId = $user_id;
        $this->status = $status;
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
    public function getTimeStart(): string
    {
        return $this->timeStart;
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
    public function getTimeEnd(): string
    {
        return $this->timeEnd;
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
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @return string
     */
    public function getDateEnd(): string
    {
        return $this->dateEnd;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getNote(): ?string
    {
        return $this->note;
    }
}
