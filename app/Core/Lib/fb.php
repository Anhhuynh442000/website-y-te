<?php

declare(strict_types=1);

namespace App\Core\Lib;

use App\Core\Helper\Helper;
use Facebook\Facebook;

class fb
{
    public $fb;
    public function __construct()
    {
        $this->fb = new Facebook(
            [
                'app_id' => '338858344828382', // Replace with your app id
                'app_secret' => '296632e82568c03c2846e1cfc588fe61',  // Replace with your app secret
                'default_graph_version' => 'v13.0',
            ]
        );
    }
    public function createLinkRedirect()
    {
        $helper = $this->fb->getRedirectLoginHelper();
        $permission = array('email');
        $login_fb =  $helper->getLoginUrl('https://quangmap.dev/phpmvc-user-test/public/user/facebook-redirect', $permission);
        return $login_fb;
    }
    public function getProfile()
    {

        $profile_request = $this->fb->get('/me?fields=name, id,first_name,last_name, middle_name, email');
        $requestPicture = $this->fb->get('/me/picture?redirect=false&height=200'); //getting user picture
        $picture = $requestPicture->getGraphUser();
        $profile = $profile_request->getGraphUser();


        $infomation = array(
            'first_name'=>$profile['first_name'],
            'last_name'=>$profile['last_name'],
            'email'=>$profile['email'],
            'face_id'=>$profile['id'],
            'avatar'=>$picture['url'],
        );
        return $infomation;
    }
}
