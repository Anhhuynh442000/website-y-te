<?php
declare(strict_types=1);

namespace App\use_case;

use App\Core\Helper\UploadFile;
use App\Core\Session;
use App\domain\entity\Blog;
use App\domain\repository\BlogRepository;
use App\domain\repository\BlogRepositoryInterface;

class AddBlogUseCase
{
    private BlogRepositoryInterface $blogRepository;
    private Session $session;

    public function __construct()
    {
        $this->blogRepository = new BlogRepository();
        $this->session = new Session();
    }

    public function execute(string $title, array $file, string $content): int
    {
        $blog = $this->buildBlog($title, $file, $content);

        if (!$this->validateBlog($blog)) {
            return 0;
        }

        if (!empty($blog->getAvatar())) {
            if (!$this->uploadAvatar($file)) {
                return 0;
            }
        }

        return $this->blogRepository->addBlog($blog);
    }

    private function uploadAvatar(array $file): bool
    {
        $upload = new UploadFile($file);
        $isSuccess = $upload->upload('blog/avatars/');

        if (!$isSuccess) {
            $this->session->setFlash('errorAddBlog', 'Upload avatar fail');
            return false;
        }

        return true;
    }

    private function validateBlog(Blog $blog): bool
    {
        if (empty($blog->getTitle())) {
            $this->session->setFlash('errorAddBlog', 'Title is not empty');
            return false;
        }

        if (empty($blog->getContent())) {
            $this->session->setFlash('errorAddBlog', 'Content is not empty');
            return false;
        }

        return true;
    }

    private function buildBlog(string $title, array $file, string $content): Blog
    {
        return new Blog(null, $title, $file['name'], $content);
    }
}
