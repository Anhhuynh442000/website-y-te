<?php
declare(strict_types=1);

namespace App\domain\entity;

class Blog
{
    private ?int $id;
    private string $title;
    private ?string $avatar;
    private string $content;

    public function __construct(?int $id, string $title, ?string $avatar, string $content)
    {
        $this->id = $id;
        $this->title = $title;
        $this->avatar = $avatar;
        $this->content = $content;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
