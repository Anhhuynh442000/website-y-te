<?php

declare(strict_types=1);

namespace App\domain\repository;

use App\domain\entity\Health;

interface HealthRepositoryInterface
{
    public function deleteHealth(int $id): bool;

    public function addHealth(Health $health): int;
}
