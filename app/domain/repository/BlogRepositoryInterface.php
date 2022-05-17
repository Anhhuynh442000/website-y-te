<?php
declare(strict_types=1);

namespace App\domain\repository;

use App\domain\entity\Blog;

interface BlogRepositoryInterface
{
    /**
     * @param int $id
     * @return Blog|array
     */
    public function getBlogById(int $id);

    public function addBlog(Blog $blog): int;

    public function addBlogWithImage(Blog $blog): int;

    public function addBlogWithoutImage(Blog $blog): int;

    public function editBlog(Blog $blog): bool;

    public function editBlogWithoutImage(Blog $blog): bool;

    public function editBlogWithImage(Blog $blog): bool;
}
