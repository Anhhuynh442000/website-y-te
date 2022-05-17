<?php
declare(strict_types=1);

namespace App\Controllers;
use App\Model\Blog;
use App\Core\Controller\BaseController;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class BlogController extends BaseController
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function getViewBlogList(): string {
        return $this->twig->render('admin/pages/blog_list');
    }

    // Lấy danh sách blog cho trang chủ user
    public function getAllBlogList():string{
        $blog = new Blog();
        $data = (array)$blog->getAllBlog();
        // echo("<pre>");
        // print_r($data);
        // foreach($data as $key=>$value)
        // {
        //     echo("<pre>");
        //     print_r($value->id);
        // }
        return $this->twig->render('user/pages/blog', ['data'=>$data]);
    }


    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function getViewBlogAdd(): string {
        return $this->twig->render('admin/pages/blog_add');
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function getViewBlogDetail(): string {
        return $this->twig->render('admin/pages/blog_detail');
    }
    public function getViewBlogByUser(): string {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $blog = new Blog();
            $data = $blog->getBlogById($id)[0];
            // echo("<pre>");
            // print_r($data);
        }
        else{
            $data = "Hiện không có bài viết này";
        }
        return $this->twig->render('user/pages/detail-blog', ['blog'=>$data]);
    }
}
