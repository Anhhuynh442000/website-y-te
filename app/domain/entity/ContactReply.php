<?php

declare(strict_types=1);

namespace App\domain\entity;

class ContactReply
{
    private ?int $id;
    private string $email;
    private string $phone;
    private ?string $title;
    private ?string $message;
    private ?string $full_name;
    private ?int $contact_id;
    private ?string $time;

    public function __construct(
        ?int $id,
        string $email,
        string $phone,
        ?string $title = null,
        ?string $message = null,
        ?string $full_name = null,
        ?int $contact_id = null,
        ?string $time = null
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->phone = $phone;
        $this->title = $title;
        $this->message = $message;
        $this->full_name = $full_name;
        $this->contact_id = $contact_id;
        $this->time = $time;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getFullName(): ?string
    {
        return $this->full_name;
    }

    public function getContactId(): ?int
    {
        return $this->contact_id;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }
}
