<?php
declare(strict_types=1);

namespace App\dto;

class AttendeesForViewDetailDto
{
    private ?int $id;
    private string $fullName;
    private string $gender;
    private int $role;

    public function __construct(?int $id, string $full_name, string $gender, int $role)
    {
        $this->id = $id;
        $this->fullName = $full_name;
        $this->gender = $gender;
        $this->role = $role;
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
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @return int
     */
    public function getRole(): int
    {
        return $this->role;
    }


    /**
     * @return string|null
     */
    public function getNote(): ?string
    {
        return $this->note;
    }
}
