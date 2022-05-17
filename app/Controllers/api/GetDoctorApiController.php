<?php

declare(strict_types=1);

namespace App\Controllers\api;

use App\Core\Controller\BaseController;
use App\domain\factory\DoctorForAddCalendarFactory;
use App\use_case\api\GetDoctorUseCase;

class GetDoctorApiController extends BaseController
{
    public function get()
    {
        $use_case = new GetDoctorUseCase();
        $doctor_factory = $use_case->execute();
        return $this->response->json_encode($this->createResponse($doctor_factory));
    }

    /**
     * @param DoctorForAddCalendarFactory[] $doctors_factory
     */
    public function createResponse(array $doctors_factory): array
    {
        $data = [];
        foreach ($doctors_factory as $doctor_factory) {
            $temp = [];
            $temp['id'] = $doctor_factory->getDoctorForAddCalendarDto()->getId();
            $temp['full_name'] = $doctor_factory->getDoctorForAddCalendarDto()->getName();
            $temp['email'] = $doctor_factory->getDoctorForAddCalendarDto()->getEmail();
            $temp['phone'] = $doctor_factory->getDoctorForAddCalendarDto()->getPhone();
            $data[] = $temp;
        }
        return $data;
    }
}
