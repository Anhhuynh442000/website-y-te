<?php

declare(strict_types=1);

namespace App\use_case\api;

use App\domain\factory\DoctorForAddCalendarFactory;
use App\query_services\GetDoctorQueryService;

class GetDoctorUseCase
{
    private GetDoctorQueryService $getDoctorQueryService;

    public function __construct()
    {
        $this->getDoctorQueryService = new GetDoctorQueryService();
    }

    /**
     * @return DoctorForAddCalendarFactory[]
     */
    public function execute(): array {
        return $this->getDoctorQueryService->getAllDoctor();
    }
}
