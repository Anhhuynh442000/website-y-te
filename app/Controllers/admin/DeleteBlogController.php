<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Controller\BaseController;
use App\use_case\DeleteBlogUseCase;

class DeleteBlogController extends BaseController
{
    public function delete() {
        $id = $this->request->input->getInt('blog-id');
        $use_case = new DeleteBlogUseCase();
        $use_case->execute($id);
        $this->response->redirect('/admin/blog-list');
    }
}
