<?php

declare(strict_types=1);

namespace App\use_case\api;

use App\domain\entity\HealthInsurance;
use App\domain\entity\MedicalFile;
use App\domain\repository\HealthInsuranceRepository;
use App\domain\repository\HealthInsuranceRepositoryInterface;
use App\domain\repository\MedicalFileRepository;
use App\domain\repository\MedicalFileRepositoryInterface;
use App\errors\MedicalFile as MedicalFileError;
use App\legacy\Auth;

class AddMedicalFileApiUseCase
{
    private MedicalFileRepositoryInterface $medicalFileRepository;
    private HealthInsuranceRepositoryInterface $healthInsuranceRepository;
    private Auth $auth;
    private MedicalFileError $medicalFileError;

    public function __construct()
    {
        $this->medicalFileRepository = new MedicalFileRepository();
        $this->healthInsuranceRepository = new HealthInsuranceRepository();
        $this->medicalFileError = new MedicalFileError();
        $this->auth = new Auth();
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
        string $expiration_date
    ) {
        $medicalFile = $this->medicalFileRepository->getMedicalFileByIdentityCard($identity_card);
        if (!is_null($medicalFile->getId())) {
            return $this->medicalFileError->getError('MED-0002');
        }
        $medicalFileToInsert = $this->buildMedicalFile(
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
            $this->auth->getUser()->getId()
        );
        $idMedicalFile = $this->medicalFileRepository->addMedicalFile($medicalFileToInsert);
        if (!$idMedicalFile) {
            return $this->medicalFileError->getError('MED-0003');
        }

        $healthInsurance = $this->validateHealthInsurance($health_insurance_number, $expiration_date);
        $healthInsuranceForInsert = $this->buildHealthInsurance(
            $healthInsurance['health_insurance'],
            (string)($healthInsurance['health_insurance_number'] ?? ''),
            (string)($healthInsurance['expiration_date'] ?? ''),
            $idMedicalFile
        );

        $idHealthInsurance = $this->healthInsuranceRepository->addHealthInsurance($healthInsuranceForInsert);
        if (!$idHealthInsurance) {
            return $this->medicalFileError->getError('MED-0003');
        }

        return ['id' => $idHealthInsurance];
    }

    private function validateHealthInsurance(
        string $health_insurance_number,
        string $expiration_date
    ): array {
        $healthInsuranceData = [
            'health_insurance' => 0,
        ];

        if (!empty($health_insurance_number) && !empty($expiration_date)) {
            $healthInsuranceData['health_insurance'] = 1;
            $healthInsuranceData['health_insurance_number'] = $health_insurance_number;
            $healthInsuranceData['expiration_date'] = $expiration_date;
        }

        return $healthInsuranceData;
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
        int $user_id
    ): MedicalFile {
        return new MedicalFile(
            null,
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
            $user_id
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
}
