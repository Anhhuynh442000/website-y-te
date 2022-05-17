<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller\BaseController;
use App\Core\Request\Request;
use App\Core\Helper\UploadFile;
use App\Core\Session;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use App\Core\Lib\QrCode;
use App\Model\User;
use App\Model\MedicalFile;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Core\Lib\Token;
use App\Core\Helper\Helper;
use App\Core\Auth\Authentication;

class MedicalHealthsController extends BaseController
{
    public function index()
    {

        $session = new Session();
        $data_user = (array)$session->get('user');
        // echo("<pre>");
        // print_r($data_user);
        return $this->twig->render('user/pages/medical_healths_declaration', ['data_user' => $data_user]);
    }
    public function store()
    {
        $request = new Request();
        $fullName = trim($this->request->input->get('full-name'));
        $email = trim($this->request->input->get('email'));

        $birthday = $this->request->input->get('birthday');
        $way = trim($this->request->input->get('way'));
        $wards = trim($this->request->input->get('wards'));
        $phone = trim($this->request->input->get('phone'));
        $gender = $this->request->input->get('gender');
        $district = trim($this->request->input->get('district'));
        $province = trim($this->request->input->get('province'));
        $identity_card = trim($this->request->input->get('identity_card'));
        $user_id = $this->request->input->get('user_id');
        
        $healths = serialize(array(
            $this->request->input->get('sign'),
            $this->request->input->get('country'),
            $this->request->input->get('sick'),
            $this->request->input->get('contact'),
            $this->request->input->get('symptoms'),
        ));
        $information = array(
            'full_name'=>$fullName,
            'gender'=>$gender,
            'birthday'=>$birthday,
            'identity_card'=>$identity_card,
            'email'=>$email,
            'phone'=>$phone,
            'way'=>$way,
            'wards'=>$wards,
            'district'=>$district,
            'province'=>$province,
            'health_declaration'=>$healths,
            'user_id'=>$user_id

        );
        // echo("<pre>");
        // print_r($information);

        $medicalFile = new MedicalFile();
        $session = new Session();
        if($medicalFile->addMedicalHealths($information))
        {
            $session->setFlash('addHealthSuccess', 'Khai báo thành công');
            $this->response->redirect('/user/medical-healths');
        }
        else{
            $session->setFlash('addHealthFailed', 'Vui lòng kiểm tra lại thông tin');
            $this->response->redirect('/user/medical-healths');
        }
    }
}
