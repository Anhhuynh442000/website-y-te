<?php

declare(strict_types=1);

namespace App\use_case\api;

use App\dto\api\MedicalFileForApiDto;
use App\errors\MedicalFile as MedicalFileError;
use App\query_services\MedicalFileQueryService;
use App\query_services\MedicalFileQueryServiceInterface;

class GetMedicalFileApiUseCase
{
    private MedicalFileQueryServiceInterface $medicalFileQueryService;
    private MedicalFileError $medicalFileError;

    public function __construct()
    {
        $this->medicalFileQueryService = new MedicalFileQueryService();
        $this->medicalFileError = new MedicalFileError();
    }

    public function execute(int $id): array
    {
        $medical_file = $this->medicalFileQueryService->getMedicalFile($id);
        if (is_null($medical_file->getId())) {
            return $this->medicalFileError->getError('MED-0001');
        }
        return $this->createResponse($medical_file);
    }

    private function createResponse(MedicalFileForApiDto $medical_file): array
    {
        return [
            'id' => $medical_file->getId(),
            'first_name' => $medical_file->getFirstName(),
            'last_name' => $medical_file->getLastName(),
            'gender' => $medical_file->getGender(),
            'birthday' => $medical_file->getBirthday(),
            'identity_card' => $medical_file->getIdentityCard(),
            'email' => $medical_file->getEmail(),
            'phone' => $medical_file->getPhone(),
            'way' => $medical_file->getWay(),
            'district' => $medical_file->getDistrict(),
            'wards' => $medical_file->getWards(),
            'province' => $medical_file->getProvince(),
            'covid_vaccination' => unserialize($medical_file->getCovidVaccination()),
            'user_id' => $medical_file->getUserId(),
            'health_insurance' => $medical_file->getHealthInsurance(),
            'health_insurance_number' => $medical_file->getHealthInsuranceNumber(),
            'has_health_insurance' => !(empty(
                $medical_file->getHealthInsurance()
                ) && empty($medical_file->getHealthInsuranceNumber())),
            'expired_date' => $medical_file->getExpiredDate(),
        ];
    }
}
