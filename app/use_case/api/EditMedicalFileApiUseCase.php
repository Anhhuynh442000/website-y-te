<?php

declare(strict_types=1);

namespace App\use_case\api;

use App\domain\entity\HealthInsurance;
use App\domain\entity\MedicalFile;
use App\domain\repository\HealthInsuranceRepository;
use App\domain\repository\MedicalFileRepository;
use App\dto\api\MedicalFileForApiDto;
use App\errors\MedicalFile as MedicalFileError;
use App\query_services\MedicalFileQueryService;

class EditMedicalFileApiUseCase
{
    private MedicalFileRepository $medicalFileRepository;
    private HealthInsuranceRepository $healthInsuranceRepository;
    private MedicalFileQueryService $medicalFileQueryService;
    private MedicalFileError $medicalFileError;

    public function __construct()
    {
        $this->medicalFileRepository = new MedicalFileRepository();
        $this->healthInsuranceRepository = new HealthInsuranceRepository();
        $this->medicalFileQueryService = new MedicalFileQueryService();
        $this->medicalFileError = new MedicalFileError();
    }

    public function execute(
        string $first_name,
        string $last_name,
        string $email,
        string $gender,
        string $birthday,
        string $phone,
        string $identity_card,
        string $province,
        string $district,
        string $wards,
        string $way,
        array $covid_vaccination,
        string $health_insurance_number,
        string $expiration_date,
        int $has_health_insurance,
        int $medical_file_id
    ): array {
        $medical_file = $this->buildMedicalFile(
            $first_name,
            $last_name,
            $email,
            $gender,
            $birthday,
            $phone,
            $identity_card,
            $province,
            $district,
            $wards,
            $way,
            $covid_vaccination,
            $medical_file_id
        );
        $health_insurance_for_update = $this->buildHealthInsurance(
            $has_health_insurance,
            $health_insurance_number,
            $expiration_date,
            $medical_file_id
        );
        $health_insurance = $this->healthInsuranceRepository->getHealthInsuranceByMedicalFileId($medical_file_id);
        if (is_null($health_insurance->getId())) {
            return $this->medicalFileError->getError('MED-0001');
        }
        $is_update_medical_file_success = $this->medicalFileRepository->updateMedicalFile($medical_file);
        if (!$is_update_medical_file_success) {
            return $this->medicalFileError->getError('MED-0005');
        }
        $is_update_health_insurance_success = $this->healthInsuranceRepository->editHealthInsuranceByMedicalFileId(
            $health_insurance_for_update
        );
        if (!$is_update_health_insurance_success) {
            return $this->medicalFileError->getError('MED-0006');
        }

        $medical_file_after_edit = $this->medicalFileQueryService->getMedicalFile($medical_file_id);
        return $this->createResponse($medical_file_after_edit);
    }

    private function buildMedicalFile(
        string $first_name,
        string $last_name,
        string $email,
        string $gender,
        string $birthday,
        string $phone,
        string $identity_card,
        string $province,
        string $district,
        string $wards,
        string $way,
        array $covid_vaccination,
        int $medical_file_id
    ): MedicalFile {
        return new MedicalFile(
            $medical_file_id,
            $first_name,
            $last_name,
            $gender,
            $birthday,
            $identity_card,
            $email,
            $phone,
            $way,
            $district,
            $wards,
            $province,
            serialize($covid_vaccination),
            null
        );
    }

    private function buildHealthInsurance(
        int $health_insurance,
        string $health_insurance_number,
        string $expiration_date,
        int $medical_records_id
    ): HealthInsurance {
        return new HealthInsurance($health_insurance, $health_insurance_number, $expiration_date, $medical_records_id);
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
            'covid_vaccinations' => unserialize($medical_file->getCovidVaccination()),
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
