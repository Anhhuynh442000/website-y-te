<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\MedicalFile;

class MedicalFileRepository
{
    public function getMedicalFiles(int $offset): array
    {
        $medicalFile = new MedicalFile();
        return $this->convertMedicalFile($medicalFile->getMedicalFiles($offset));
    }

    public function getMedicalFileDetail(string $medicalFileId): array
    {
        $medicalFile = new MedicalFile();
        $medicalFileDetail = $medicalFile->getMedicalFileDetail($medicalFileId);
        if (empty($medicalFileDetail)) {
            return [];
        }

        return $this->convertMedicalDetail($medicalFileDetail);
    }

    public function getHealths(string $medicalFileId): array
    {
        $medicalFile = new MedicalFile();
        $heaths = $medicalFile->getHealths($medicalFileId);
        if (empty($heaths)) {
            return [];
        }
        return $this->convertHealths($heaths);
    }

    public function getHealthDetail(string $heathId): array
    {
        $medicalFile = new MedicalFile();
        return $this->convertHealthDetail($medicalFile->getHealthDetail($heathId));
    }

    public function getMedicineList(): array {
        $medicalFile = new MedicalFile();
        return $medicalFile->getMedicineList();
    }

    private function convertHealthDetail(array $heath): array
    {
        $data['id'] = $heath['id'];
        $data['summary'] = $heath['summary'];
//        $data['symptom'] = $this->convertSymptom(unserialize($heath['healths']));
        $data['note'] = $heath['note'];
        $data['medical_file_id'] = $heath['id_medical_records'];
        return $data;
    }

    private function convertSymptom(array $symptom): array
    {
        $data = [];
        $data['fever'] = $symptom['fever'] === '1' ? 'Yes' : 'No';
        $data['cold'] = $symptom['cold'] === '1' ? 'Yes' : 'No';
        $data['sore_throat'] = $symptom['sore_throat'] === '1' ? 'Yes' : 'No';

        return $data;
    }

    private function convertHealths(array $heaths): array
    {
        $data = [];
        foreach ($heaths as $heath) {
            $temp = [];
            $temp['id'] = $heath['id'];
            $temp['summary'] = $heath['summary'];
            $temp['date'] = $heath['date'];
            array_push($data, $temp);
        }

        return $data;
    }

    private function convertMedicalFile(array $medicalFiles): array
    {
        $data = [];
        foreach ($medicalFiles as $medicalFile) {
            $temp = [];
            $temp['id'] = $medicalFile['id'];
            $temp['full_name'] = $medicalFile['first_name'] . ' ' . $medicalFile['last_name'];
            $temp['gender'] = $medicalFile['gender'];
            $temp['birthday'] = $medicalFile['birthday'];
            $temp['phone'] = $medicalFile['phone'];
            $temp['identity_card'] = $medicalFile['identity_card'];
            $temp['age'] = $this->calculateAge($temp['birthday']);
            $data[] = $temp;
        }
        return $data;
    }

    private function convertMedicalDetail(array $medicalFile): array
    {
        $data = [];
        $data['id'] = $medicalFile['id'] ?? '';
        $data['insurance_id'] = $medicalFile['insurance_id'] ?? '';
        $data['first_name'] = $medicalFile['first_name'] ?? '';
        $data['last_name'] = $medicalFile['last_name'] ?? '';
        $data['birthday'] = $medicalFile['birthday'] ?? '';
        $data['age'] = $this->calculateAge($medicalFile['birthday']);
        $data['gender'] = $medicalFile['gender'] ?? '';
        $data['identity_card'] = $medicalFile['identity_card'] ?? '';
        $data['email'] = $medicalFile['email'] ?? '';
        $data['phone'] = $medicalFile['phone'] ?? '';
        $data['way'] = $medicalFile['way'] ?? '';
        $data['district'] = $medicalFile['district'] ?? '';
        $data['wards'] = $medicalFile['wards'] ?? '';
        $data['province'] = $medicalFile['province'] ?? '';
        $data['full_address'] = $data['way'] . ', ' . $data['district'] . ', ' . $data['wards'] . ', ' . $data['province'];
        $data['covid_injections'] = $this->convertCovidVaccinationInjection($medicalFile['covid_vaccination'] ?? '');
        $data['created_at'] = $medicalFile['created_at'] ?? '';
        $data['user_id'] = $medicalFile['user_id'] ?? '';
        $data['health_insurance'] = $medicalFile['health_insurance'] ?? '';
        $data['health_insurance_number'] = $medicalFile['health_insurance_number'] ?? '';
        $data['expiration_date'] = $medicalFile['expiration_date'] ?? '';
        $data['qr_image'] = $medicalFile['qr_image'] ?? '';

        return $data;
    }

    private function convertCovidVaccinationInjection(string $covid_vaccination): array
    {
        if (empty($covid_vaccination)) {
            return [];
        }

        $covidVaccinations = unserialize($covid_vaccination);
        $data = [];
        $injections = 1;
        foreach ($covidVaccinations as $covidVaccinationInjection) {
            $temp = [];
            $temp['injection'] = $injections;
            $temp['type_medicine'] = $covidVaccinationInjection['type_vaccine'];
            $temp['date'] = $covidVaccinationInjection['date'];
            $injections += 1;
            $data[] = $temp;
        }
        return $data;
    }

    private function calculateAge(string $date)
    {
        $birthDate = explode('-', $date);
        $currentYear = (int)date("Y");
        if ((int)$birthDate[0] === $currentYear) {
            return 0;
        }
        $timestamp = mktime(0, 0, 0, (int)$birthDate[2], (int)$birthDate[1], (int)$birthDate[0]);
        $date = date("U", $timestamp);

        return (date("md", (int)$date) > date("md")
            ? ((date("Y") - $birthDate[0]) - 1)
            : (date("Y") - $birthDate[0]));
    }
}
