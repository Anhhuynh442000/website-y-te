<?php

declare(strict_types=1);

namespace App\errors;

use App\Core\Error\AbstractError;

class Health extends AbstractError
{
    public function errors(): array
    {
        return [
            [
                'code' => 'HEA-0001',
                'message' => 'Can\'t find the health',
                'detail' => 'Can\'t find the health specified'
            ],
        ];
    }
}