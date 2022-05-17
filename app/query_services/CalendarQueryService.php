<?php

declare(strict_types=1);

namespace App\query_services;

use App\Core\Database\Query;
use App\domain\factory\AttendeesForViewDetailFactory;
use App\domain\factory\CalendarForViewFactory;

class CalendarQueryService implements CalendarQueryServiceInterface
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

    public function getCalendarById(int $user_id, int $calendar_id): CalendarForViewFactory
    {
        $sql = "SELECT A.id, A.subject, A.full_name, A.description, A.date_start, A.date_end, A.status, A.user_id, A.note
                FROM medical_appointments AS A INNER JOIN medical_appointment_attendees AA ON A.id = AA.id_appointment
                WHERE A.id = %s AND AA.user_id = %s";
        $query = sprintf($sql, $calendar_id, $user_id);
        $result = $this->db->query($query);
        if ($result->num_rows == 0) {
            return new CalendarForViewFactory(null, '', '', '', '', '', 0, 0, 0);
        }
        $row = $result->fetch_assoc();

        return new CalendarForViewFactory(
            (int)$row['id'],
            $row['subject'],
            $row['full_name'],
            $row['date_start'],
            $row['date_end'],
            $row['description'],
            (int)$row['status'],
            (int)$row['user_id'],
            null,
            $row['note']
        );
    }

    /**
     * @param int $calendar_id
     * @return array|AttendeesForViewDetailFactory[]
     */
    public function getAllAttendeesByCalendarId(int $calendar_id): array
    {
        $sql = "SELECT U.id, UP.first_name, UP.last_name, U.role, UP.gender FROM medical_appointment_attendees AS AA
                INNER JOIN medical_users AS U ON AA.user_id = U.id
                INNER JOIN medical_user_profiles AS UP ON U.id = UP.user_id
                WHERE AA.id_appointment = %s";
        $query = sprintf($sql, $calendar_id);
        $result = $this->db->query($query);

        $data = [];
        if ($result->num_rows === 0) {
            return $data;
        }
        while ($row = $result->fetch_assoc()) {
            $data[(int)$row['id']] = new AttendeesForViewDetailFactory(
                (int)$row['id'],
                $row['first_name'],
                $row['last_name'],
                $row['gender'],
                (int)$row['role']
            );
        }
        return $data;
    }

    /**
     * @param int $user_id
     * @return array|CalendarForViewFactory[]
     */
    public function getAllCalendarDoctorByDoctorId(int $user_id): array
    {
        $sql = "SELECT A.id, A.subject, A.full_name, A.date_start, A.date_end, A.description, A.status, A.user_id, AA.id_appointment, AA.user_id AS attendees_id
                FROM medical_appointments AS A
                INNER JOIN medical_appointment_attendees AS AA
                ON A.id=AA.id_appointment
                INNER JOIN medical_users as U ON AA.user_id = U.id
                WHERE AA.user_id = %s AND U.role = 2;";
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
