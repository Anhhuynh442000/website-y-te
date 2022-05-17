<?php

declare(strict_types=1);

namespace App\query_services;

use App\Core\Database\Query;
use App\dto\HealthDto;

class HealthQueryService implements HealthQueryServiceInterface
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

    /**
     * @param int $medical_file_id
     * @return HealthDto[]
     */
    public function getHealthByMedicalFileId(int $medical_file_id): array
    {
        $sql = "SELECT * FROM medical_healths WHERE id_medical_records = %s";
        $query = sprintf($sql, $medical_file_id);
        $result = $this->db->query($query);
        $medical_files = [];
        if ($result->num_rows === 0) {
            return $medical_files;
        }
        while ($row = $result->fetch_assoc()) {
            $medical_files[(int)$row['id']] = new HealthDto(
                (int)$row['id'],
                $row['summary'],
                $row['healths'],
                $row['note'],
                $row['date']
            );
        }
        return $medical_files;
    }
}
