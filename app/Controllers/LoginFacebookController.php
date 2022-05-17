<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Model\Blog;
use App\Core\Controller\BaseController;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use PHPMailer\PHPMailer\SMTP;
use App\Core\Lib\fb;
use App\Core\Session;
use App\Model\User;
use Facebook\Facebook;
use App\Core\Auth\Authentication;

class LoginFacebookController extends BaseController
{

    public function Store()
    {
        $fb = new fb();
        $helper = $fb->fb->getRedirectLoginHelper();
        $accessToken = $helper->getAccessToken();
        // $longLivedAccessToken = $accessToken->extend();
        $session = new Session();
        $session->set('accessToken', $accessToken);

        $fb->fb->setDefaultAccessToken($session->get('accessToken'));


        $information = $fb->getProfile();
        $dataUser = array(
            'email' => $information['email'],
            'role' => 1,
            'status' => 1,
            'face_id' => $information['face_id'],
            'token' => $accessToken->getValue(),
        );

        $user = new User();
        $session = new Session();

        $checkUserByFaceId = (array)$user->checkExistFaceId($dataUser['face_id']);
        if (!empty($checkUserByFaceId)) {
            $user_info = (array)$checkUserByFaceId;
            $session->set('user', $user_info[0]);
            return $this->response->redirect('/');
        } else {
            $userId = $user->addUser($dataUser);
            $dataUserProfile =  array(
                'first_name' => $information['first_name'],
                'last_name' => $information['last_name'],
                'avatar' => $information['avatar'],
                'user_id' => $userId,
            );
            $user->addUserProfile($dataUserProfile);
            $data_profile = $user->getProfileByUserId($userId);
            $session->set('user', (array)$data_profile[0]);
            return $this->response->redirect('/');
        }
    }
}
