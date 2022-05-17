<?php

declare(strict_types=1);

namespace App\domain\repository;

use App\Core\Database\Query;
use App\domain\entity\Prescription;

class PrescriptionRepository implements PrescriptionRepositoryInterface
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

    public function addPrescription(Prescription $prescription): int
    {
        $sql = "INSERT INTO medical_prescriptions(name, age, address, gender, note, medicine, healths_id, user_id)
                VALUES ('%s', %s, '%s', '%s', '%s', %s, %s)";
        $query = sprintf(
            $sql,
            $prescription->getFullName(),
            $prescription->getAge(),
            $prescription->getAddress(),
            $prescription->getGender(),
            $prescription->getNote(),
            $prescription->getMedicineList(),
            $prescription->getHealthId(),
            $prescription->getUserId()
        );

        $this->db->query($query);

        return (int)$this->db->insert_id;
    }

    public function editPrescription(Prescription $prescription): bool
    {
        $sql = "UPDATE medical_prescriptions
                SET name = '%s', age = %s, address = '%s', note = '%s', medicine = '%s', gender = '%s'
                WHERE id = %s";
        $query = sprintf(
            $sql,
            $prescription->getFullName(),
            $prescription->getAge(),
            $prescription->getAddress(),
            $prescription->getNote(),
            $prescription->getMedicineList(),
            $prescription->getGender(),
            $prescription->getId(),
        );
        if (!$this->db->query($query)) {
            return false;
        }
        return true;
    }
}
