<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\AddMedicalFileUseCase;

class AddMedicalFileController extends BaseController
{
    public function addMedicalFile()
    {
        $useCase = new AddMedicalFileUseCase();
        $input = $this->parseInput();
        $id = $useCase->execute(
            $input['first_name'],
            $input['last_name'],
            $input['email'],
            $input['gender'],
            $input['birthday'],
            $input['phone'],
            $input['identity_card'],
            $input['province'],
            $input['district'],
            $input['wards'],
            $input['way'],
            $input['covid_vaccination'],
            $input['health_insurance_number'],
            $input['expiration_date'],
        );
        if (!$id) {
            $this->response->redirect('/admin/medical-file-add');
        }
        $this->response->redirect('/admin/medical-file-detail', ['id' => $id]);
    }

    private function convertDate(string $date) {
        $originalDate = $date;
        return date("Y-m-d", strtotime($originalDate));
    }

    private function parseInput(): array
    {
        $firstName = $this->request->input->get('first-name');
        $lastName = $this->request->input->get('last-name');
        $email = $this->request->input->get('email');
        $gender = $this->request->input->get('gender');
        $birthday = $this->request->input->get('birthday');
        $phone = $this->request->input->get('phone');
        $identityCard = $this->request->input->get('identity-card');
        $province = $this->request->input->get('province');
        $district = $this->request->input->get('district');
        $wards = $this->request->input->get('wards');
        $way = $this->request->input->get('way');
        $healthInsuranceNumber = $this->request->input->get('health-insurance-number');
        $expiration_date = $this->request->input->get('expiration-date');

        $covidVaccination = [];
        for ($i = 1; $i <= 3; $i++) {
            $temp = [];
            $vaccineName = $this->request->input->get("name-${i}");
            $date = $this->convertDate($this->request->input->get("date-${i}"));
            if (empty($vaccineName) && empty($date)) {
                continue;
            }
            $temp['type_vaccine'] = $vaccineName;
            $temp['date'] = $date;
            $covidVaccination[] = $temp;
        }

        return [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'gender' => $gender,
            'birthday' => $birthday,
            'phone' => $phone,
            'identity_card' => $identityCard,
            'province' => $province,
            'district' => $district,
            'wards' => $wards,
            'way' => $way,
            'covid_vaccination' => $covidVaccination,
            'health_insurance_number' => $healthInsuranceNumber,
            'expiration_date' => $expiration_date
        ];
    }
}
