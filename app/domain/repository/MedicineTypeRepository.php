<?php

declare(strict_types=1);

namespace App\domain\repository;

use App\Core\Database\Query;
use App\domain\entity\MedicineType;

class MedicineTypeRepository implements MedicineTypeRepositoryInterface
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

    public function addMedicineType(MedicineType $medicine_type): int
    {
        $sql = "INSERT INTO medical_medicines_types(name, description) VALUES ('%s', '%s')";
        $query = sprintf($sql, $medicine_type->getName(), $medicine_type->getDescription());
        $this->db->query($query);

        return (int)$this->db->insert_id;
    }
}
