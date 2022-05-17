<?php

declare(strict_types=1);

namespace App\dto;

class HealthDto
{
    private int $id;
    private string $summary;
    private string $health;
    private string $note;
    private string $date;

    public function __construct(int $id, string $summary, string $health, string $note, string $date)
    {
        $this->id = $id;
        $this->summary = $summary;
        $this->health = $health;
        $this->note = $note;
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * @return string
     */
    public function getHealth(): string
    {
        return $this->health;
    }

    /**
     * @return string
     */
    public function getNote(): string
    {
        return $this->note;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }
}
