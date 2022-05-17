<?php

declare(strict_types=1);

namespace App\dto;

class DoctorForAddCalendarDto
{
    private ?int $id;
    private string $name;
    private string $role;
    private ?string $email;
    private ?string $phone;

    public function __construct(?int $id, string $name, string $role, ?string $email = null, ?string $phone = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->role = $role;
        $this->email = $email;
        $this->phone = $phone;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }
}
