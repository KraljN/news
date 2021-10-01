<?php

namespace App\Mail;

use App\Config;
use App\Models\Model;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

abstract class Mail{

    protected $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->IsSMTP();
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->Port = 587; 
        $this->mail->SMTPSecure = 'tls';
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = Config::getConfig('EMAIL_ADDRESS');
        $this->mail->Password   = Config::getConfig('EMAIL_PASSWORD'); 
        $this->mail->isHTML(true);
    }
    public abstract function sendMail($objectChanged, $id);

}