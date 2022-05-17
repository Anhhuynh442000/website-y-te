<?php

declare(strict_types=1);

namespace App\errors;

use App\Core\Error\AbstractError;

class Prescription extends AbstractError
{
    public function errors(): array
    {
        return [
            [
                'code' => 'PRE-0001',
                'message' => 'Prescription not found',
                'detail' => 'Can\'t find the prescription specified'
            ],
        ];
    }
}
