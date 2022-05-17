<?php

declare(strict_types=1);

namespace App\dto;

class PrescriptionDto
{
    private ?int $id;
    private string $fullName;
    private ?string $gender;
    private ?int $age;
    private string $address;
    private string $note;
    private string $medicineList;
    private ?int $health_id;
    private ?int $user_id;

    public function __construct(
        ?int $id,
        string $full_name,
        ?string $gender,
        ?int $age,
        string $address,
        string $note,
        string $medicine_list,
        ?int $health_id,
        ?int $user_id
    ) {
        $this->id = $id;
        $this->fullName = $full_name;
        $this->gender = $gender;
        $this->age = $age;
        $this->address = $address;
        $this->note = $note;
        $this->medicineList = $medicine_list;
        $this->health_id = $health_id;
        $this->user_id = $user_id;
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
     * @return null|string
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @return int
     */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
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
    public function getMedicineList(): string
    {
        return $this->medicineList;
    }

    /**
     * @return int
     */
    public function getHealthId(): ?int
    {
        return $this->health_id;
    }

    /**
     * @return int
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }
}
