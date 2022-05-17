<?php

declare(strict_types=1);

namespace App\query_services;

use App\Core\Database\Query;
use App\dto\MedicineDto;

class MedicineDetailQueryService implements MedicineDetailQueryServiceInterface
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

    public function getMedicineDetailById(int $id): MedicineDto
    {
        $sql = "SELECT M.id, M.name, M.unit, MT.name AS type_name, M.description
                FROM `medical_medicines` AS M INNER JOIN `medical_medicines_types` AS MT
                ON m.`medicine_type_id`=MT.id WHERE M.id = %s";
        $query = sprintf($sql, $id);
        $result = $this->db->query($query);
        if ($result->num_rows === 0) {
            return new MedicineDto(null, '', '', null, null);
        }
        $row = $result->fetch_assoc();

        return new MedicineDto((int)$row['id'], $row['name'], $row['type_name'], $row['description'], $row['unit']);
    }
}
