<?php
declare(strict_types=1);

namespace App\query_services;

use App\dto\BlogDto;

interface BlogDetailQueryServiceInterface
{
    public function getBlog(string $id): BlogDto;
}
