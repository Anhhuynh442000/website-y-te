<?php
declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\EditBlogUseCase;

class EditBlogController extends BaseController
{
    public function editBlog()
    {
        $id = $this->request->input->get('id');
        $title = $this->request->input->get('title');
        $content = $this->request->input->get('content');
        $avatar = $this->request->input->get('avatar');

        $editBlogUseCase = new EditBlogUseCase();
        $editBlogUseCase->execute($id, $title, $content, $avatar);

        $this->response->redirect('/admin/blog-detail', ['id' => $id]);
    }
}
