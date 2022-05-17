<?php

declare(strict_types=1);

namespace App\query_services;

use App\Core\Database\Query;
use App\dto\PrescriptionDto;

class PrescriptionQueryService implements PrescriptionQueryServiceInterface
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

    public function getPrescriptionById(int $id): PrescriptionDto
    {
        $sql = "SELECT * FROM `medical_prescriptions` WHERE id = %s";
        $query = sprintf($sql, $id);
        $result = $this->db->query($query);
        if ($result->num_rows === 0) {
            return new PrescriptionDto(null, '', null, null, '', '', '', null, null);
        }
        $row = $result->fetch_assoc();
        return new PrescriptionDto(
            (int)$row['id'],
            $row['name'],
            $row['gender'],
            (int)$row['age'],
            $row['address'],
            $row['note'],
            $row['medicine'],
            (int)$row['healths_id'],
            (int)$row['user_id']
        );
    }
}
