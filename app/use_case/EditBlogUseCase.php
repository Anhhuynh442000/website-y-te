<?php
declare(strict_types=1);

namespace App\use_case;

use App\Core\Helper\UploadFile;
use App\Core\Session;
use App\domain\entity\Blog;
use App\domain\repository\BlogRepository;
use App\domain\repository\BlogRepositoryInterface;

class EditBlogUseCase
{
    private BlogRepositoryInterface $blogRepository;
    private Session $session;

    public function __construct()
    {
        $this->blogRepository = new BlogRepository();
        $this->session = new Session();
    }

    public function execute(string $id, string $title, string $content, array $file): bool
    {
        $blog = $this->blogRepository->getBlogById((int)$id);
        if (empty($blog)) {
            return false;
        }

        $blogInfo = $this->buildBlogInfo($id, $title, $content, $file);

        if (!is_null($blogInfo->getAvatar())) {
            if (!$this->uploadAvatar($file)) {
                $this->session->setFlash('errorUpdateBlog', 'Upload avatar fail');
                return false;
            }
        }

        $isSuccess = $this->blogRepository->editBlog($blogInfo);
        if (!$isSuccess) {
            $this->session->setFlash('errorUpdateBlog', 'Edit blog fail');
            return false;
        }

        $this->session->setFlash('successUpdateBlog', 'Edit blog success');
        return true;
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

    private function buildBlogInfo(string $id, string $title, string $content, array $file): Blog
    {
        $filename = empty($file['name']) ? null : $file['name'];
        return new Blog((int)$id, $title, $filename, $content);
    }
}
