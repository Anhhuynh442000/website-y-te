<?php

declare(strict_types=1);

namespace App\query_services\api;

use App\Core\Database\Query;
use App\domain\factory\CalendarForViewFactory;

class CalendarApiQueryService implements CalendarApiQueryServiceInterface
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
     * @param int $user_id
     * @return array|CalendarForViewFactory[]
     */
    public function getAllEventByUserId(int $user_id): array
    {
        $sql = "SELECT A.id, A.subject, A.full_name, A.date_start, A.date_end, A.description, A.status, A.user_id, AA.id_appointment, AA.user_id AS attendees_id 
                FROM medical_appointments AS A 
                INNER JOIN medical_appointment_attendees AS AA 
                ON A.id=AA.id_appointment WHERE AA.user_id = %s
                GROUP BY AA.id_appointment";
        $query = sprintf($sql, $user_id);
        $result = $this->db->query($query);
        $data = [];
        if ($result->num_rows == 0) {
            return [];
        }

        while ($row = $result->fetch_assoc()) {
            $data[(int)$row['id']] = new CalendarForViewFactory(
                (int)$row['id'],
                $row['subject'],
                $row['full_name'],
                $row['date_start'],
                $row['date_end'],
                $row['description'],
                (int)$row['status'],
                (int)$row['user_id'],
                (int)$row['attendees_id']
            );
        }

        return $data;
    }
}