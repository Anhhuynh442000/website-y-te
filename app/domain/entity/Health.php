<?php

declare(strict_types=1);

namespace App\domain\entity;

class Health
{
    private string $summary;
    private string $health;
    private string $note;
    private int $medicalFileId;

    public function __construct(
        string $summary,
        string $health,
        string $note,
        int $medical_file_id
    ) {
        $this->summary = $summary;
        $this->health = $health;
        $this->note = $note;
        $this->medicalFileId = $medical_file_id;
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
     * @return int
     */
    public function getMedicalFileId(): int
    {
        return $this->medicalFileId;
    }
}
