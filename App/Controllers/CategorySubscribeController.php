<?php

namespace App\Controllers;

use App\Helper;
use App\Validator;
use Exception;
use App\Models\Category;

class CategorySubscribeController extends SubscribeController{

    public function subscribe($id){
        $validator = new Validator();
        $data  = [
            "email"=> $_POST['email']
        ];
        $validator->validate($data);
        if($validator->getValidity()){
            $category = new Category();
            $subscribers = $category->getSubscribers($id);
            if(!Helper::isEmailSubscribed($data["email"], $subscribers)){
                try{
                    $category->subscribe($data['email'], $id);
                    $_SESSION['success'] = "You successfully subscribed to this category!";
                    header("Location: " . Helper::route("/categories/" . $id));
                }
                catch(Exception $e){
                    $_SESSION['error'] = "There has been problem subscribing to this category, please try again later";
                    header("Location: " . Helper::route("/categories/" . $id));
                }
            }
            else{
                $_SESSION['error'] = "You are already subscribed to this category.";
                header("Location: " . Helper::route("/categories/" . $id));
            }
        }
        else{
            $_SESSION['validationError'] = $validator->getErrors();
            header("Location: " . Helper::route("/categories/" . $id));
        }
    }

}
