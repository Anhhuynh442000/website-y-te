<?php

declare(strict_types=1);

namespace App\domain\repository;

use App\Core\Database\Query;
use App\domain\entity\HealthInsurance;

class HealthInsuranceRepository implements HealthInsuranceRepositoryInterface
{
    /**
     * @var false|\mysqli|null
     */
    private $db;

    public function __construct()
    {
        $query = new Query();
        $this->db = $query->getDatabase()->mysql;
    }

    public function addHealthInsurance(HealthInsurance $health_insurance): int
    {
        $sql = "INSERT INTO medical_medical_insurances (health_insurance, health_insurance_number, expiration_date, id_medical_records)
                VALUES (%s, '%s', '%s', %s)";
        $query = sprintf(
            $sql,
            $health_insurance->getHealthInsurance(),
            $health_insurance->getHealthInsuranceNumber(),
            $health_insurance->getExpirationDate(),
            $health_insurance->getMedicalRecordsId()
        );
        $this->db->query($query);

        return (int)$this->db->insert_id;
    }

    public function getHealthInsuranceByMedicalFileId(int $medical_file_id): HealthInsurance
    {
        $sql = "SELECT * FROM medical_medical_insurances WHERE id_medical_records = %s";
        $query = sprintf($sql, $medical_file_id);
        $result = $this->db->query($query);
        if ($result->num_rows === 0) {
            return new HealthInsurance(null);
        }
        $row = $result->fetch_assoc();
        return new HealthInsurance(
            (int)$row['health_insurance'],
            $row['health_insurance_number'],
            $row['expiration_date'],
            null,
            (int)$row['id']
        );
    }

    public function editHealthInsuranceByMedicalFileId(HealthInsurance $health_insurance): bool
    {
        $sql = "UPDATE medical_medical_insurances
                SET health_insurance = %s, health_insurance_number = '%s', expiration_date = '%s'
                WHERE id_medical_records = %s";
        $query = sprintf(
            $sql,
            $health_insurance->getHealthInsurance(),
            $health_insurance->getHealthInsuranceNumber(),
            $health_insurance->getExpirationDate(),
            $health_insurance->getMedicalRecordsId()
        );
        if (!$this->db->query($query)) {
            return false;
        }

        return true;
    }
}
