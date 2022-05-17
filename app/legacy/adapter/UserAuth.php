<?php

declare(strict_types=1);

namespace App\legacy\adapter;

class UserAuth
{
    private ?int $id;
    private ?string $email;
    private ?string $password;
    private ?int $status;
    private ?string $token;
    private ?int $role;

    public function __construct(?int $id, ?string $email, ?string $password, ?int $status, ?string $token, ?int $role)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->status = $status;
        $this->token = $token;
        $this->role = $role;
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
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return ?string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @return ?int
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @return ?string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @return ?int
     */
    public function getRole(): ?int
    {
        return $this->role;
    }
}