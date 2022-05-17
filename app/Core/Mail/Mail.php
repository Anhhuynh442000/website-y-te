<?php

declare(strict_types=1);

namespace App\Core\Mail;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mail
{
    private PHPMailer $phpMailer;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->phpMailer = new PHPMailer(true);
        $this->loadConfig();
    }

    /**
     * @throws Exception
     */
    private function loadConfig()
    {
        $this->phpMailer->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $this->phpMailer->isSMTP();                                            //Send using SMTP
        $this->phpMailer->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $this->phpMailer->SMTPAuth = true;                                   //Enable SMTP authentication
        $this->phpMailer->Username = 'huntercq7@gmail.com';                     //SMTP username
        $this->phpMailer->Password = 'phanxico@4';                               //SMTP password
        $this->phpMailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $this->phpMailer->Port = 465;
        $this->phpMailer->setFrom('huntercq7@gmail.com', 'Trung Hieu');
        $this->phpMailer->isHTML(true);
    }

    /**
     * @throws Exception
     */
    public function setToAddress(string $mail, string $name = '')
    {
        $this->phpMailer->addAddress($mail, $name);
    }

    /**
     * @throws Exception
     */
    public function setReplyTo(string $mail, string $name = '')
    {
        $this->phpMailer->addReplyTo($mail, $name);
    }

    public function setSubject(string $subject = '')
    {
        $this->phpMailer->Subject = $subject;
    }

    public function setBody(string $body = '')
    {
        $this->phpMailer->Body = $body;
    }

    public function setAltBody(string $alt_body)
    {
        $this->phpMailer->AltBody = $alt_body;
    }

    public function send()
    {
        try {
            $this->phpMailer->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->phpMailer->ErrorInfo}";
        }
    }
}
