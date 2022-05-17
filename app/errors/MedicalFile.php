<?php

declare(strict_types=1);

namespace App\errors;

use App\Core\Error\AbstractError;

class MedicalFile extends AbstractError
{
    public function errors(): array
    {
        return [
            [
                'code' => 'MED-0001',
                'message' => 'Medical file not found',
                'detail' => 'Can\'t find the medical file specified'
            ],
            [
                'code' => 'MED-0002',
                'message' => 'Can\'t add the medical file',
                'detail' => 'The identity card already exist'
            ],
            [
                'code' => 'MED-0003',
                'message' => 'Add the medical file fail',
                'detail' => 'Check the information of the medical file'
            ],
            [
                'code' => 'MED-0004',
                'message' => 'Add health insurance fail',
                'detail' => 'Check the information of the health insurance'
            ],
            [
                'code' => 'MED-0005',
                'message' => 'Edit the medical file fail',
                'detail' => 'Check the information of the medical file'
            ],
            [
                'code' => 'MED-0006',
                'message' => 'Edit health insurance fail',
                'detail' => 'Check the information of the health insurance'
            ],
            [
                'code' => 'MED-0007',
                'message' => 'Delete the medical file fail',
                'detail' => 'Check the id of the medical file'
            ],
        ];
    }
}
