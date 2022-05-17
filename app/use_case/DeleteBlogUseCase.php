<?php

declare(strict_types=1);

namespace App\use_case;

use App\Core\Session;
use App\domain\repository\BlogRepository;
use App\domain\repository\BlogRepositoryInterface;

class DeleteBlogUseCase
{
    private BlogRepositoryInterface $blogRepository;
    private Session $session;

    public function __construct()
    {
        $this->blogRepository = new BlogRepository();
        $this->session = new Session();
    }

    public function execute(int $id): bool
    {
        $isSuccess = $this->blogRepository->deleteBlogById($id);
        if (!$isSuccess) {
            $this->session->setFlash('errorDeleteBlog', 'Delete blog fail');
            return false;
        }
        $this->session->setFlash('successDeleteBlog', 'Delete blog success');
        return true;
    }
}
