<?php

declare(strict_types=1);

namespace App\domain\repository;

use App\Core\Database\Query;
use App\domain\entity\ContactReply;

class ContactRepository implements ContactRepositoryInterface
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

    public function replyContact(ContactReply $contact): int
    {
        $sql = "INSERT INTO medical_contact_reply (email, phone, message, full_name, contact_id)
                VALUES ('%s', '%s', '%s', '%s', %s)";
        $query = sprintf(
            $sql,
            $contact->getEmail(),
            $contact->getPhone(),
            $contact->getMessage(),
            $contact->getFullName(),
            $contact->getContactId()
        );

        $this->db->query($query);

        return (int)$this->db->insert_id;
    }

    public function deleteContact(string $email): bool
    {
        $sql = "DELETE FROM medical_contact_information WHERE email = '%s';";
        $query = sprintf($sql, $email);

        if ($this->db->query($query)) {
            return true;
        }

        return false;
    }
}
