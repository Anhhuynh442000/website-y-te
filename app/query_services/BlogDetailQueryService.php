<?php
declare(strict_types=1);

namespace App\query_services;

use App\Core\Database\Query;
use App\dto\BlogDto;

class BlogDetailQueryService implements BlogDetailQueryServiceInterface
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

    public function getBlog(string $id): BlogDto  {
        $sql = "SELECT * FROM medical_blogs WHERE id=%s;";
        $query = sprintf($sql, $id);
        $result = $this->db->query($query);
        $row = $result->fetch_assoc();
        if ($result->num_rows <= 0){
            return new BlogDto('', '', '', '');
        }

        return new BlogDto($row['id'], $row['title'], $row['content'], $row['created_at']);
    }
}
