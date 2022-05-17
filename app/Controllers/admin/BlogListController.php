<?php
declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\ViewBlogListUseCase;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class BlogListController extends BaseController
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function getViewBlogList(): string
    {
        if ($this->request->input->has('offset')) {
            $offset = $this->request->input->getInt('offset');
        } else {
            $offset = 0;
        }
        $viewBlogListUseCase = new ViewBlogListUseCase();
        $blogList = $viewBlogListUseCase->execute($offset);
        $blogs = $this->createResponseData($blogList);
        return $this->twig->render('admin/pages/blog_list', ['blogs' => $blogs, 'total' => count($blogs)]);
    }

    private function createResponseData(array $blogList): array
    {
        $data = [];
        foreach ($blogList as $blog) {
            $temp = [];
            $temp['id'] = $blog->getId();
            $temp['title'] = $blog->getTitle();
            $temp['created_time'] = $blog->getCreatedTime();
            $data[] = $temp;
        }

        return $data;
    }
}
