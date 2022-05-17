<?php
declare(strict_types=1);

namespace App\Model;

use App\Core\Database\DBModel;
use App\Core\Database\Query;

class MedicalFile extends DBModel
{
    public const LIMIT_QUERY = 10;

    public function rules(): array
    {
        return [];
    }

    public function getMedicalFiles(int $offset): array {
        $query = "SELECT id, first_name, last_name, gender, identity_card, birthday, phone FROM medical_medical_records LIMIT %s, %s;";
        $query = sprintf($query, $offset, self::LIMIT_QUERY);
        $result = $this->getDatabase()->mysql->query($query);
        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    public function getMedicalFileDetail(string $medicalFileId): array {
        $query = <<<SQL
                    SELECT MR.id, first_name, last_name, gender, birthday, identity_card, email, phone, way, district, wards, province, covid_vaccination, MR.created_at, user_id, MI.health_insurance,
                           MI.health_insurance_number, MI.expiration_date, MI.id AS insurance_id, MR.qr_image
                    FROM medical_medical_records AS MR INNER JOIN medical_medical_insurances AS MI ON MR.id=MI.id_medical_records
                    WHERE MR.id=$medicalFileId
                SQL;
        $result = $this->getDatabase()->mysql->query($query);
        $num = $result->num_rows;
        if ($num > 0) {
            return $result->fetch_assoc();
        }

        return [];
    }

    public function addMedicalFile(array $information)
    {
        $query = new Query();
        return $query->table('medical_medical_records')->insert($information);
    }

    public function updateMedicalFile(array $information, string $medicalFileId): bool
    {
        $query = new Query();
        return $query->table('medical_medical_records')->update($information, ['id' => $medicalFileId]);
    }

    public function addHealthInsurance(array $information)
    {
        $query = new Query();
        return $query->table('medical_medical_insurances')->insert($information);
    }

    public function updateHealthInsurance(array $information, string $heathInsurancesId): bool
    {
        $query = new Query();
        return $query->table('medical_medical_insurances')->update($information, ['id' => $heathInsurancesId]);
    }

    public function editHealth(array $information, string $healthId): bool
    {
        $query = new Query();
        return $query->table('medical_healths')->update($information, ['id' => $healthId]);
    }

    public function getInfoByIdentityCard(string $identityCard): int {
        $query = "SELECT * FROM `medical_medical_records` WHERE identity_card = '$identityCard'";
        $result = $this->getDatabase()->mysql->query($query);
        return $result->num_rows;
    }

    public function getInfoByIdentityCardExceptCurrent(string $identityCard, string $medicalFileId): int {
        $query = "SELECT * FROM `medical_medical_records` WHERE identity_card = '$identityCard' AND id <> '$medicalFileId'";
        $result = $this->getDatabase()->mysql->query($query);
        return $result->num_rows;
    }

    public function getHealths(string $medicalFileId): array {
        $query = "SELECT * FROM `medical_healths` WHERE id_medical_records=$medicalFileId";
        $result = $this->getDatabase()->mysql->query($query);
        $data = [];

        if ($result->num_rows === 0) {
            return $data;
        }

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    public function getHealthDetail(string $healthId): array {
        $query = "SELECT * FROM `medical_healths` WHERE id=$healthId";
        $result = $this->getDatabase()->mysql->query($query);
        $nums = $result->num_rows;
        if ($nums === 0) {
            return [];
        }

        return $result->fetch_assoc();
    }

    public function getMedicineList(): array {
        $query = "SELECT * FROM `medical_medicines`";
        $result = $this->getDatabase()->mysql->query($query);
        $data = [];

        if ($result->num_rows === 0) {
            return $data;
        }

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }
    public function addMedicalHealths(array $information)
    {
        $query = new Query();
        return $query->table('medical_health_declaration')->insert($information);
    }
}
