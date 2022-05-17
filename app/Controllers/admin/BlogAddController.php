<?php
declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\AddBlogUseCase;

class BlogAddController extends BaseController
{
    public function addBlog()
    {
        $title = $this->request->input->get('title');
        $avatar = $this->request->input->get('avatar');
        $content = $this->request->input->get('content');

        $addBlogUseCase = new AddBlogUseCase();
        $id = $addBlogUseCase->execute($title, $avatar, $content);

        if (!$id) {
            $this->response->redirect('/admin/blog-add');
        }

        $this->response->redirect('/admin/blog-detail', ['id' => $id]);
    }
}
