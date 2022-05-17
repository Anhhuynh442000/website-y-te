<?php

declare(strict_types=1);

namespace App\Core\Error;

abstract class AbstractError
{
    public function getError($code): array
    {
        foreach ($this->errors() as $error) {
            if ($error['code'] === $code) {
                return $error;
            }
        }
        return [];
    }

    abstract public function errors(): array;
}
