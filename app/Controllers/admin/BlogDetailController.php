<?php
declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\dto\BlogDto;
use App\use_case\ViewBlogDetailUseCase;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class BlogDetailController extends BaseController
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function getViewBlogDetail(): string
    {
        $id = $this->request->input->get('id');

        $viewBlogDetailUseCase = new ViewBlogDetailUseCase();
        $blog = $viewBlogDetailUseCase->execute($id);

        return $this->twig->render('admin/pages/blog_detail', ['blog' => $this->createResponseData($blog)]);
    }

    private function createResponseData(BlogDto $blog): array
    {
        return [
            'id' => $blog->getId(),
            'title' => $blog->getTitle(),
            'content' => trim($blog->getContent()),
        ];
    }
}
