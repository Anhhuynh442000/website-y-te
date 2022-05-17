<?php

declare(strict_types=1);

namespace App\query_services;

use App\Core\Database\Query;
use App\dto\MedicineDto;

class MedicineListQueryService implements MedicineListQueryServiceInterface
{
    public const LIMIT = 10;
    /**
     * @var false|\mysqli|null
     */
    private $db;

    public function __construct()
    {
        $query = new Query();
        $this->db = $query->getDatabase()->mysql;
    }

    /**
     * @return MedicineDto[]|array
     */
    public function getListMedicine(int $offset): array
    {
        $query = "SELECT M.id, M.name, MT.name AS type_name
                FROM `medical_medicines` AS M INNER JOIN `medical_medicines_types` AS MT
                ON m.`medicine_type_id`=MT.id LIMIT %s, %s";
        $query = sprintf($query, $offset, self::LIMIT);
        $result = $this->db->query($query);
        if (!$result) {
            return [];
        }
        if ($result->num_rows === 0) {
            return [];
        }
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[(int)$row['id']] = new MedicineDto((int)$row['id'], $row['name'], $row['type_name'], null);
        }

        return $data;
    }

    public function getTotalMedicine(): int
    {
        $query = "SELECT COUNT(*) AS total_medicines FROM medical_medicines;";
        $result = $this->db->query($query);
        $row = $result->fetch_assoc();
        return (int)$row['total_medicines'];
    }
}
