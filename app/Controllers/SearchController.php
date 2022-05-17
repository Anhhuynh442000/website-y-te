<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller\BaseController;
use App\Model\Blog;
use App\Core\Request\Request;
use App\Core\Session;
use App\Model\User;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class SearchController extends BaseController
{
    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
   public function SearchDoctor()
   {
        $keyword = trim($this->request->input->get('keyword'));
        $user = new User();
        $data = $user->getDoctorByKeyWord($keyword);
        return $this->twig->render('user/pages/doctor', ['getListUser' => $data]);
   }
}
