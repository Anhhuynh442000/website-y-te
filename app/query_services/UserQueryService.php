<?php

declare(strict_types=1);

namespace App\query_services;

use App\Core\Database\Query;

class UserQueryService implements UserQueryServiceInterface
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

    public function getTotalUser(): int
    {
        $query = "SELECT count(*) AS total_users FROM medical_users;";
        $result = $this->db->query($query);
        $row = $result->fetch_assoc();
        return (int)$row['total_users'];
    }
}
