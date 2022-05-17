<?php

declare(strict_types=1);

namespace App\dto\api;

class AttendeesForApiDto
{
    private int $id;
    private string $full_name;
    private string $first_name;
    private string $last_name;
    private string $gender;
    private string $birthday;
    private string $email;
    private int $role;

    public function __construct(
        int $id,
        string $full_name,
        string $first_name,
        string $last_name,
        string $gender,
        string $birthday,
        string $email,
        int $role
    ) {
        $this->id = $id;
        $this->full_name = $full_name;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->gender = $gender;
        $this->birthday = $birthday;
        $this->email = $email;
        $this->role = $role;
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
    public function getFullName(): string
    {
        return $this->full_name;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @return string
     */
    public function getBirthday(): string
    {
        return $this->birthday;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getRole(): int
    {
        return $this->role;
    }
}
