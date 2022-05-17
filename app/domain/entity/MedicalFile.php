<?php

declare(strict_types=1);

namespace App\domain\entity;

class MedicalFile
{
    private ?int $id;
    private string $first_name;
    private string $last_name;
    private string $gender;
    private string $birth_day;
    private string $identity_card;
    private string $email;
    private string $phone;
    private string $way;
    private string $district;
    private string $wards;
    private string $province;
    private string $covid_vaccination;
    private ?int $user_id;
    private ?string $qr_image;

    public function __construct(
        ?int $id,
        string $first_name,
        string $last_name,
        string $gender,
        string $birth_day,
        string $identity_card,
        string $email,
        string $phone,
        string $way,
        string $district,
        string $wards,
        string $province,
        string $covid_vaccination,
        ?int $user_id = null,
        ?string $qr_image = null
    ) {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->gender = $gender;
        $this->birth_day = $birth_day;
        $this->identity_card = $identity_card;
        $this->email = $email;
        $this->phone = $phone;
        $this->way = $way;
        $this->district = $district;
        $this->wards = $wards;
        $this->province = $province;
        $this->covid_vaccination = $covid_vaccination;
        $this->user_id = $user_id;
        $this->qr_image = $qr_image;
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
    public function getBirthDay(): string
    {
        return $this->birth_day;
    }

    /**
     * @return string
     */
    public function getIdentityCard(): string
    {
        return $this->identity_card;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getWay(): string
    {
        return $this->way;
    }

    /**
     * @return string
     */
    public function getDistrict(): string
    {
        return $this->district;
    }

    /**
     * @return string
     */
    public function getWards(): string
    {
        return $this->wards;
    }

    /**
     * @return string
     */
    public function getProvince(): string
    {
        return $this->province;
    }

    /**
     * @return string
     */
    public function getCovidVaccination(): string
    {
        return $this->covid_vaccination;
    }

    /**
     * @return int
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    /**
     * @return string|null
     */
    public function getQrImage(): ?string
    {
        return $this->qr_image;
    }
}
