<?php

declare(strict_types=1);

namespace App\domain\repository;

use App\Core\Database\Query;
use App\domain\entity\Blog;

class BlogRepository implements BlogRepositoryInterface
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

    /**
     * @param int $id
     * @return Blog|array
     */
    public function getBlogById(int $id)
    {
        $sql = "SELECT * FROM medical_blogs WHERE id=%s;";
        $query = sprintf($sql, $id);
        $result = $this->db->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new Blog((int)$row['id'], $row['title'], $row['image'], $row['content']);
        }

        return [];
    }

    public function addBlog(Blog $blog): int
    {
        if (empty($blog->getAvatar())) {
            return $this->addBlogWithoutImage($blog);
        }

        return $this->addBlogWithImage($blog);
    }

    public function addBlogWithoutImage(Blog $blog): int
    {
        $sql = "INSERT INTO medical_blogs (title, content, user_id) VALUES ('%s', '%s', %s);";
        $query = sprintf($sql, $blog->getTitle(), $blog->getContent(), 1);
        $this->db->query($query);

        return (int)$this->db->insert_id;
    }

    public function addBlogWithImage(Blog $blog): int
    {
        $sql = "INSERT INTO medical_blogs (title, content, image, user_id) VALUES ('%s', '%s', '%s' ,%s);";
        $query = sprintf($sql, $blog->getTitle(), $blog->getContent(), $blog->getAvatar(), 1);
        $this->db->query($query);

        return (int)$this->db->insert_id;
    }

    public function editBlog(Blog $blog): bool
    {
        if (is_null($blog->getAvatar())) {
            return $this->editBlogWithoutImage($blog);
        }

        return $this->editBlogWithImage($blog);
    }

    public function editBlogWithoutImage(Blog $blog): bool
    {
        $sql = "UPDATE medical_blogs SET title='%s', content='%s' WHERE id=%s;";
        $query = sprintf($sql, $blog->getTitle(), $blog->getContent(), $blog->getId());

        return $this->db->query($query);
    }

    public function editBlogWithImage(Blog $blog): bool
    {
        $sql = "UPDATE medical_blogs SET title='%s', content='%s', image='%s' WHERE id=%s;";
        $query = sprintf($sql, $blog->getTitle(), $blog->getContent(), $blog->getAvatar(), $blog->getId());;

        return $this->db->query($query);
    }

    public function deleteBlogById(int $id): bool
    {
        $sql = "DELETE FROM medical_blogs WHERE id = %s";
        $query = sprintf($sql, $id);
        if (!$this->db->query($query)) {
            return false;
        }

        return true;
    }
}
