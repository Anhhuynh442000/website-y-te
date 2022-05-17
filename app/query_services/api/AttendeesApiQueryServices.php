<?php

declare(strict_types=1);

namespace App\query_services\api;

use App\Core\Database\Query;
use App\dto\api\AttendeesForApiDto;

class AttendeesApiQueryServices implements AttendeesApiQueryServicesInterface
{
    /**
     * @var mixed
     */
    private $db;

    public function __construct()
    {
        $query = new Query();
        $this->db = $query->getDatabase()->mysql;
    }

    /**
     * @param int $id
     * @return AttendeesForApiDto[]
     */
    public function findAttendeesByCalendarId(int $id): array
    {
        $sql = "SELECT U.id, A.full_name, UP.first_name, UP.last_name, UP.gender, UP.birthday, U.email, U.role 
                FROM medical_appointment_attendees AS AA 
                INNER JOIN medical_users AS U ON AA.user_id=U.id 
                INNER JOIN medical_user_profiles AS UP ON U.id = UP.user_id
                INNER JOIN medical_appointments AS A ON A.id = AA.id_appointment
                WHERE AA.id_appointment=%s";
        $query = sprintf($sql, $id);
        $result = $this->db->query($query);
        $data = [];
        if ($result->num_rows === 0) {
            return $data;
        }
        while ($row = $result->fetch_assoc()) {
            $data[(int)$row['id']] = new AttendeesForApiDto(
                (int)$row['id'],
                $row['full_name'],
                $row['first_name'],
                $row['last_name'],
                $row['gender'],
                $row['birthday'],
                $row['email'],
                (int)$row['role']
            );
        }

        return $data;
    }
}
