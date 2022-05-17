<?php

declare(strict_types=1);

namespace App\domain\entity;

class HealthInsurance
{
    private ?int $health_insurance;
    private ?string $health_insurance_number;
    private ?string $expiration_date;
    private ?int $medical_records_id;
    private ?int $id;

    public function __construct(
        ?int $health_insurance,
        string $health_insurance_number = null,
        string $expiration_date = null,
        int $medical_records_id = null,
        int $id = null
    ) {
        $this->health_insurance = $health_insurance;
        $this->health_insurance_number = $health_insurance_number;
        $this->expiration_date = $expiration_date;
        $this->medical_records_id = $medical_records_id;
        $this->id = $id;
    }

    /**
     * @return ?int
     */
    public function getHealthInsurance(): ?int
    {
        return $this->health_insurance;
    }

    /**
     * @return ?string
     */
    public function getHealthInsuranceNumber(): ?string
    {
        return $this->health_insurance_number;
    }

    /**
     * @return ?string
     */
    public function getExpirationDate(): ?string
    {
        return $this->expiration_date;
    }

    /**
     * @return ?int
     */
    public function getMedicalRecordsId(): ?int
    {
        return $this->medical_records_id;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
