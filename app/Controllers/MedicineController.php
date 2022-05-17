<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller\BaseController;
use App\Core\Lib\QrCode;
use App\Core\Request\Request;
use App\Core\Session;
use App\Model\User;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use App\Core\Helper\Helper;

class MedicineController extends BaseController
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function getViewMedicineList(): string {
        return $this->twig->render('admin/pages/medicine_list');
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function getViewMedicineDetail(): string {
        return $this->twig->render('admin/pages/medicine_detail');
    }
    public function getViewMedicanRecord()
    {
        $session = new Session();
        $id_user = (array)$session->get('user');

        // echo("<pre>");
        // print_r($id_user['id']);
        $user = new User();
        $data_user = (array)$user->getMedicianRecordById($id_user['id']);
        // echo("<pre>");
        // print_r($data_user);
        if(!empty($data_user))
        {
            return $this->twig->render('user/pages/medican_record', ['data_user'=>(array)$data_user[0]]);
        }
        return $this->twig->render('user/pages/medican_record', ['data_user'=>'']);
     
    }
    public function postMedicanRecord()
    {
        $request = new Request();
        $session = new Session();

        echo("<pre>");


        // Lấy id của user ra
        $data_user = (array)$session->get('user');


        // Lấy dữ liệu từ form
        $firstname = $this->request->input->get('first-name');
        $lastname = $this->request->input->get('last-name');
        $gender = $this->request->input->get('gender');
        $email = $this->request->input->get('email');
        $birthday = $this->request->input->get('birthday');
        $phone = $this->request->input->get('phone');
        $way = $this->request->input->get('way');
        $identity_card = $this->request->input->get('identity_card');
        $province = $this->request->input->get('province');
        $covid_vaccination = $this->request->input->get('covid_vaccination');
        $district = $this->request->input->get('district');
        $wards = $this->request->input->get('wards');


        $qrCode = new QrCode();
        $helper = new Helper();
        $qr_profile = $helper->custom_link('user/medican-record') . "?user_id=" . $data_user['id'];
        $qrName = $this->generateRandomString(15);
        $qrCode->create($qr_profile, $qrName);

        $infomation = array(
            'first_name'=>$firstname,
            'last_name'=>$lastname,
            'gender'=>$gender,
            'email'=>$email,
            'birthday'=>$birthday,
            'phone'=>$phone,
            'way'=>$way,
            'identity_card'=> $identity_card,
            'province'=>$province,
            'covid_vaccination'=>$covid_vaccination,
            'district' => $district,
            'wards'=>$wards,
            'created_at'=>date('Y-m-d'),
            'user_id'=>$data_user['id'],
            'qr_image' => $qrName . '.png'
        );
        $user = new User();

        if($user->insertMedicianRecord($infomation))
        {
            $session->setFlash('success', 'Khai báo thành công');
            $this->response->redirect('/user/medican-record');
        }
        else{
            $session->setFlash('error', 'Vui lòng kiểm tra lại');
            $this->response->redirect('/user/medican-record');
        }

    }
    public function updateMedicanRecord()
    {
        $request = new Request();
        $session = new Session();

    
        // // Lấy dữ liệu từ form
        $firstname = trim($this->request->input->get('first-name'));
        $id_user = trim($_GET['id_user']);
        $lastname = $this->request->input->get('last-name');
        $gender = $this->request->input->get('gender');
        $email = $this->request->input->get('email');
        $birthday = $this->request->input->get('birthday');
        $phone = $this->request->input->get('phone');
        $way = $this->request->input->get('way');
        $identity_card = $this->request->input->get('identity_card');
        $province = $this->request->input->get('province');
        $covid_vaccination = $this->request->input->get('covid_vaccination');
        $district = $this->request->input->get('district');
        $wards = $this->request->input->get('wards');

        $infomation = array(
            'first_name'=>$firstname,
            'last_name'=>$lastname,
            'gender'=>$gender,
            'email'=>$email,
            'birthday'=>$birthday,
            'phone'=>$phone,
            'way'=>$way,
            'identity_card'=> $identity_card,
            'province'=>$province,
            'covid_vaccination'=>$covid_vaccination,
            'district' => $district,
            'wards'=>$wards,
            'created_at'=>date('Y-m-d'),
            'user_id'=>$id_user,

        );
        $user = new User();

        if($user->updateMedicianRecord($id_user,$infomation))
        {
            $session->setFlash('success', 'Cật nhật thành công');
            $this->response->redirect('/user/medican-record');
        }
        else{
            $session->setFlash('error', 'Vui lòng kiểm tra lại');
            $this->response->redirect('/user/medican-record');
        }

    }
    public function showCalander():string{
        return $this->twig->render('user/pages/list_book_clinic');
    }
    public function generateRandomString(int $length = 10): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
