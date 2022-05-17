<?php

declare(strict_types=1);

namespace App\query_services;

use App\Core\Database\Query;
use App\dto\ContactDto;
use App\dto\ContactListDto;

class ContactListQueryService implements ContactListQueryServiceInterface
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

    public function getContactForListView(int $offset): ContactListDto
    {
        $query = "SELECT * FROM `medical_contact_information` GROUP BY email ORDER BY `created_at` DESC LIMIT %s, %s;";
        $query = sprintf($query, $offset, self::LIMIT);
        $result = $this->db->query($query);
        if (!$result) {
            return new ContactListDto([]);
        }

        if ($result->num_rows === 0) {
            return new ContactListDto([]);
        }

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[$row['id']] = new ContactDto(
                (int)$row['id'],
                $row['email'],
                $row['phone'],
                null,
                null,
                $row['full_name']
            );
        }

        return new ContactListDto($data);
    }

    public function getTotalContact(): int
    {
        $query = "SELECT COUNT(*) AS total_contact FROM `medical_contact_information` GROUP BY email ORDER BY `created_at` DESC;";
        $result = $this->db->query($query);
        $row = $result->fetch_assoc();
        if (is_null($row)) {
            return 0;
        }
        return (int)$row['total_contact'];
    }
}
