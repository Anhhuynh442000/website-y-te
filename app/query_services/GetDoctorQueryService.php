<?php

declare(strict_types=1);

namespace App\query_services;

use App\Core\Database\Query;
use App\domain\factory\DoctorForAddCalendarFactory;

const ROLE_DOCTOR = 2;

class GetDoctorQueryService implements GetDoctorQueryServiceInterface
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
     * @return array|DoctorForAddCalendarFactory[]
     */
    public function getAllDoctor(): array
    {
        $sql = "SELECT U.id AS id, first_name, last_name, U.email, UP.phone, role FROM medical_users AS U INNER JOIN medical_user_profiles AS UP 
                ON U.id = UP.user_id
                WHERE role = %s";
        $query = sprintf($sql, ROLE_DOCTOR);
        $result = $this->db->query($query);
        $data = [];

        if ($result->num_rows === 0) {
            return $data;
        }

        while ($row = $result->fetch_assoc()) {
            $data[(int)$row['id']] = new DoctorForAddCalendarFactory(
                (int)$row['id'],
                $row['first_name'],
                $row['last_name'],
                (int)$row['role'],
                $row['email'],
                $row['phone']
            );
        }

        return $data;
    }
}
