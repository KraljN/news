<?php

namespace App\Mail;

use App\Config;
use App\Helper;
use App\Models\Category;

class CategoryMail extends Mail{

    public function sendMail($post, $categoryId){
        $this->mail->Subject = "New Post In Subscribed Category.";
        //title post, $id
        $category = new Category();
        $emails = $category->getSubscribers($categoryId);
        foreach($emails as $email){
            $this->mail->addAddress($email['email']);
        }
        $message = file_get_contents($_SERVER['DOCUMENT_ROOT'] . Config::getConfig('ROOT_PATH') . "/App/Templates/category_email.php");
        $message = str_replace("%title%", $post['title'], $message);
        $message = str_replace("%category%", $post['category_name'], $message);
        $this->mail->Body = $message;
        $this->mail->send();
    }

}
