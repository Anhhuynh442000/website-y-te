<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\domain\factory\DoctorForAddCalendarFactory;
use App\use_case\GetDoctorUserCase;

class GetDoctorController extends BaseController
{
    public function getDoctor()
    {
        $use_case = new GetDoctorUserCase();
        $doctors = $use_case->execute();
        return $this->response->json_encode($this->createResponse($doctors));
    }

    /**
     * @param array|DoctorForAddCalendarFactory[] $doctors
     */
    private function createResponse(array $doctors): array
    {
        $data = [];
        foreach ($doctors as $doctor) {
            $doctorForView = $doctor->getDoctorForAddCalendarDto();
            $temp = [];
            $temp['label'] = $doctorForView->getName();
            $temp['value'] = (string)$doctorForView->getId();
            $temp['role'] = $doctorForView->getRole();
            $data[] = $temp;
        }
        return $data;
    }
}
