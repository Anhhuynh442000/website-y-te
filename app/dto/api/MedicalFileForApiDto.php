<?php

declare(strict_types=1);

namespace App\dto\api;

class MedicalFileForApiDto
{
    private ?int $id;
    private ?string $firstName;
    private ?string $lastName;
    private ?string $gender;
    private ?string $identityCard;
    private ?string $birthday;
    private ?string $email;
    private ?string $phone;
    private ?string $way;
    private ?string $district;
    private ?string $wards;
    private ?string $province;
    private ?string $covidVaccination;
    private ?int $user_id;
    private ?string $health_insurance;
    private ?string $expired_date;
    private ?string $health_insurance_number;

    public function __construct(
        ?int $id,
        string $first_name = null,
        string $last_name = null,
        string $gender = null,
        string $birthday = null,
        string $identity_card = null,
        string $email = null,
        string $phone = null,
        string $way = null,
        string $district = null,
        string $wards = null,
        string $province = null,
        string $covid_vaccination = null,
        int $user_id = null,
        string $health_insurance = null,
        string $health_insurance_number = null,
        string $expired_date = null
    ) {
        $this->id = $id;
        $this->firstName = $first_name;
        $this->lastName = $last_name;
        $this->gender = $gender;
        $this->birthday = $birthday;
        $this->identityCard = $identity_card;
        $this->email = $email;
        $this->phone = $phone;
        $this->way = $way;
        $this->district = $district;
        $this->wards = $wards;
        $this->province = $province;
        $this->covidVaccination = $covid_vaccination;
        $this->user_id = $user_id;
        $this->health_insurance = $health_insurance;
        $this->health_insurance_number = $health_insurance_number;
        $this->expired_date = $expired_date;
    }

    /**
     * @return ?int
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
        return $this->firstName;
    }

    /**
     * @return ?string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @return ?string
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @return ?string
     */
    public function getIdentityCard(): ?string
    {
        return $this->identityCard;
    }

    /**
     * @return ?string
     */
    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    /**
     * @return ?string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return ?string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return ?string
     */
    public function getWay(): ?string
    {
        return $this->way;
    }

    /**
     * @return ?string
     */
    public function getDistrict(): ?string
    {
        return $this->district;
    }

    /**
     * @return ?string
     */
    public function getWards(): ?string
    {
        return $this->wards;
    }

    /**
     * @return ?string
     */
    public function getProvince(): ?string
    {
        return $this->province;
    }

    /**
     * @return ?string
     */
    public function getCovidVaccination(): ?string
    {
        return $this->covidVaccination;
    }

    /**
     * @return ?int
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    /**
     * @return ?string
     */
    public function getHealthInsurance(): ?string
    {
        return $this->health_insurance;
    }

    /**
     * @return ?string
     */
    public function getExpiredDate(): ?string
    {
        return $this->expired_date;
    }

    /**
     * @return ?string
     */
    public function getHealthInsuranceNumber(): ?string
    {
        return $this->health_insurance_number;
    }
}
