<?php

declare(strict_types=1);

namespace App\domain\repository;

use App\Core\Database\Query;

class AttendeesRepository implements AttendeesRepositoryInterface
{
    private Query $query;
    /**
     * @var mixed
     */
    private $db;

    public function __construct()
    {
        $this->query = new Query();
        $this->db = $this->query->getDatabase()->mysql;
    }

    public function deleteAttendeesByCalendarId(int $calendar_id): bool
    {
        $sql = "DELETE FROM `medical_appointment_attendees` WHERE id_appointment = %s";
        $query = sprintf($sql, $calendar_id);
        $result = $this->db->query($query);
        if ($result) {
            return true;
        }

        return false;
    }
}
