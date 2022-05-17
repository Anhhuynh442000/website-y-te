<?php

declare(strict_types=1);

namespace App\Controllers\admin;

use App\Core\Auth\Authentication;
use App\Core\Controller\BaseController;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class LoginSampleController extends BaseController
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function getView(): string
    {
        return $this->twig->render('admin/pages/login_sample');
    }

    public function login()
    {
        $email = $this->request->input->getString('email');
        $password = $this->request->input->getString('password');
        $authentication = new Authentication();
        $is_login = $authentication->login(['email' => $email, 'password' => $password]);
        if (!$is_login) {
            $this->response->redirect('/admin/login');
        }
        $this->response->redirect('/admin/user-list');
    }
}
