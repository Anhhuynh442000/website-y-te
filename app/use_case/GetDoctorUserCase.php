<?php

declare(strict_types=1);

namespace App\use_case;

use App\domain\factory\DoctorForAddCalendarFactory;
use App\query_services\GetDoctorQueryService;
use App\query_services\GetDoctorQueryServiceInterface;

class GetDoctorUserCase
{
    private GetDoctorQueryServiceInterface $getDoctorQueryService;

    public function __construct()
    {
        $this->getDoctorQueryService = new GetDoctorQueryService();
    }

    /**
     * @return array|DoctorForAddCalendarFactory[]
     */
    public function execute(): array
    {
        return $this->getDoctorQueryService->getAllDoctor();
    }
}
