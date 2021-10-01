<?php
namespace App\Controllers;

use App\Models\Post;
use App\Validator;
use App\Helper;
use Exception;

session_start();

class PostSubscribeController extends SubscribeController{
    
    public function subscribe($id)
    {
        $validator = new Validator();
        $data  = [
            "email"=> $_POST['email']
        ];
        $validator->validate($data);
        if($validator->getValidity()){
            $post = new Post();
            $subscribers = $post->getSubscribers($id);
            if(!Helper::isEmailSubscribed($data["email"], $subscribers)){
                try{
                    $post->subscribe($data['email'], $id);
                    $_SESSION['success'] = "You successfully subscribed to this post!";
                    header("Location: " . Helper::route("/posts/" . $id));
                }
                catch(Exception $e){
                    $_SESSION['error'] = "There has been problem subscribing to this post, please try again later";
                    header("Location: " . Helper::route("/posts/" . $id));
                }
            }
            else{
                $_SESSION['error'] = "You are already subscribed to this post.";
                header("Location: " . Helper::route("/posts/" . $id));
            }
        }
        else{
            $_SESSION['validationError'] = $validator->getErrors();
            header("Location: " . Helper::route("/posts/" . $id));
        }
    }
}