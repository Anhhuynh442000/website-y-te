<?php

declare(strict_types=1);

namespace App\query_services;

use App\Core\Database\Query;
use App\dto\BlogDto;

class BlogListQueryService implements BlogListQueryServiceInterface
{
    public const LIMIT = 10;
    /**
     * @var mixed
     */
    private $db;

    public function __construct()
    {
        $query = new Query();
        $this->db = $query->getDatabase()->mysql;
    }

    public function getBlogList(int $offset): array
    {
        $query = "SELECT * FROM medical_blogs LIMIT %s, %s;";
        $query = sprintf($query, $offset, self::LIMIT);
        $result = $this->db->query($query);
        if ($result->num_rows > 0) {
            $blogs = [];
            while ($row = $result->fetch_assoc()) {
                $blogs[$row['id']] = new BlogDto($row['id'], $row['title'], $row['content'], $row['created_at']);
            }

            return $blogs;
        }
        $result->free_result();
        return [];
    }

    public function getTotalBlog(): int
    {
        $query = "SELECT count(*) AS total_blogs FROM medical_blogs;";
        $result = $this->db->query($query);
        $row = $result->fetch_assoc();
        return (int)$row['total_blogs'];
    }
}
