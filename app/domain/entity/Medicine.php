<?php

declare(strict_types=1);

namespace App\domain\entity;

class Medicine
{
    private ?int $id;
    private string $name;
    private string $unit;
    private $quantity;
    private string $description;
    private int $typeId;

    public function __construct(?int $id, string $name, string $unit, $quantity, string $description, int $type_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->unit = $unit;
        $this->quantity = $quantity;
        $this->description = $description;
        $this->typeId = $type_id;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getTypeId(): int
    {
        return $this->typeId;
    }
}
