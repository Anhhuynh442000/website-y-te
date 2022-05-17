<?php

declare(strict_types=1);

namespace App\dto;

class MedicalFileForSearchDto
{
    private ?int $id;
    private ?string $first_name;
    private ?string $last_name;
    private ?string $phone;

    public function __construct(?int $id, string $first_name = null, string $last_name = null, string $phone = null)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
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
     * @return ?string
     */
    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    /**
     * @return ?string
     */
    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    /**
     * @return ?string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        if (is_null($this->first_name) || is_null($this->last_name)) {
            return '';
        }

        return $this->first_name . ' ' . $this->last_name;
    }
}
