<?php

declare(strict_types=1);

namespace App\use_case;

use App\Core\Helper\Helper;
use App\Core\Lib\QrCode;
use App\Core\Session;
use App\domain\entity\HealthInsurance;
use App\domain\entity\MedicalFile;
use App\domain\repository\HealthInsuranceRepository;
use App\domain\repository\HealthInsuranceRepositoryInterface;
use App\domain\repository\MedicalFileRepository;
use App\domain\repository\MedicalFileRepositoryInterface;
use App\legacy\Auth;

class AddMedicalFileUseCase
{
    private MedicalFileRepositoryInterface $medicalFileRepository;
    private HealthInsuranceRepositoryInterface $healthInsuranceRepository;
    private Session $session;
    private Auth $auth;
    private QrCode $qrCode;
    private Helper $helper;

    public function __construct()
    {
        $this->medicalFileRepository = new MedicalFileRepository();
        $this->healthInsuranceRepository = new HealthInsuranceRepository();
        $this->session = new Session();
        $this->auth = new Auth();
        $this->qrCode = new QrCode();
        $this->helper = new Helper();
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
    ): int {
        $medicalFile = $this->medicalFileRepository->getMedicalFileByIdentityCard($identity_card);
        if (!is_null($medicalFile->getId())) {
            $this->session->setFlash('errorAddMedicalFile', 'The identity card ....');
            return 0;
        }
        $qrName = $this->generateQrImage();
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
            $this->auth->getUser()->getId(),
            $qrName
        );
        $idMedicalFile = $this->medicalFileRepository->addMedicalFile($medicalFileToInsert);
        if (!$idMedicalFile) {
            $this->session->setFlash('errorAddMedicalFile', 'Add medical file fail');
            return 0;
        }

        $healthInsurance = $this->validateHealthInsurance($health_insurance_number, $expiration_date);
        $healthInsuranceForInsert = $this->buildHealthInsurance(
            $healthInsurance['health_insurance'],
            (string)$healthInsurance['health_insurance_number'],
            (string)$healthInsurance['expiration_date'],
            $idMedicalFile
        );

        $idHealthInsurance = $this->healthInsuranceRepository->addHealthInsurance($healthInsuranceForInsert);
        if (!$idHealthInsurance) {
            $this->session->setFlash('errorAddMedicalFile', 'Add medical file fail');
            return 0;
        }
        $this->session->setFlash('successAddMedicalFile', 'Add medical file success');
        return $idMedicalFile;
    }

    private function generateQrImage(): string {
        $qrName = $this->helper->generateRandomString(15);
        $this->qrCode->create('content', $qrName);
        return $qrName . '.png';
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
        int $user_id,
        string $qr_name
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
            $user_id,
            $qr_name
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
