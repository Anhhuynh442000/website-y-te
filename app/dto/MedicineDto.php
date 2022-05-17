<?php

declare(strict_types=1);

namespace App\dto;

class MedicineDto
{
    private ?int $id;
    private string $name;
    private string $typeName;
    private ?string $description;
    private ?string $unit;

    public function __construct(?int $id, string $name, string $type_name, ?string $description, ?string $unit = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->typeName = $type_name;
        $this->description = $description;
        $this->unit = $unit;
    }

    /**
     * @return null|int
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
    public function getTypeName(): string
    {
        return $this->typeName;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getUnit(): ?string
    {
        return $this->unit;
    }
}
