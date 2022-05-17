<?php

declare(strict_types=1);

namespace App\domain\repository;

use App\Core\Database\Query;
use App\domain\entity\Health;

class HealthRepository implements HealthRepositoryInterface
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

    public function deleteHealth(int $id): bool
    {
        $sql = "DELETE FROM medical_healths WHERE id = %s";
        $query = sprintf($sql, $id);

        if ($this->db->query($query)) {
            return true;
        }

        return false;
    }

    public function addHealth(Health $health): int
    {
        $sql = "INSERT INTO medical_healths (summary, healths, note, id_medical_records) VALUES ('%s', '%s', '%s', %s);";
        $query = sprintf($sql, $health->getSummary(), $health->getHealth(), $health->getNote(), $health->getMedicalFileId());
        $this->db->query($query);

        return (int)$this->db->insert_id;
    }
}
