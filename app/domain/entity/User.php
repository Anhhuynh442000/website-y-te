<?php

declare(strict_types=1);

namespace App\domain\entity;

class User
{
    private ?int $id;
    private ?string $email;
    private ?int $status;
    private ?int $role;
    private ?string $password;

    public function __construct(
        ?int $id,
        string $email = null,
        string $password = null,
        int $status = null,
        int $role = null
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->status = $status;
        $this->role = $role;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function getRole(): ?int
    {
        return $this->role;
    }
}
