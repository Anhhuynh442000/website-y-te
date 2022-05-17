<?php

declare(strict_types=1);

namespace App\domain\factory;

use App\dto\AttendeesForViewDetailDto;

class AttendeesForViewDetailFactory
{
    private ?int $id;
    private string $gender;
    private int $role;
    private string $firstName;
    private string $lastName;

    public function __construct(?int $id, string $first_name, string $last_name, string $gender, int $role)
    {
        $this->id = $id;
        $this->firstName = $first_name;
        $this->lastName = $last_name;
        $this->gender = $gender;
        $this->role = $role;
    }

    public function getAttendeesForView(): AttendeesForViewDetailDto
    {
        return new AttendeesForViewDetailDto($this->id, $this->convertFullName(), $this->gender, $this->role);
    }

    private function convertFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}
