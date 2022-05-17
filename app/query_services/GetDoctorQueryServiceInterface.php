<?php

declare(strict_types=1);

namespace App\query_services;

use App\domain\factory\DoctorForAddCalendarFactory;

interface GetDoctorQueryServiceInterface
{
    /**
     * @return array|DoctorForAddCalendarFactory[]
     */
    public function getAllDoctor(): array;
}
