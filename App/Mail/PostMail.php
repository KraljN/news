<?php

namespace App\Mail;

use App\Config;
use App\Helper;
use Exception;

class PostMail extends Mail{

    public function sendMail($postObj, $id){
        $this->mail->Subject = "Post that you are subscribed to has been updated.";
        $emails = $postObj->getSubscribers($id);
        foreach($emails as $email){
            $this->mail->addAddress($email['email']);
        }
        $post = $postObj->getSinglePost($id);
        $message = file_get_contents($_SERVER['DOCUMENT_ROOT'] . Config::getConfig('ROOT_PATH') . "/App/Templates/post_email.php");
        $message = str_replace("%title%", $post['title'], $message);
        $message = str_replace("%time%", Helper::formatDate($post['updated_at']), $message);
        $this->mail->Body = $message;
        $this->mail->send();
    }
    
}