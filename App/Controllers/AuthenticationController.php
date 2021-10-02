<?php
namespace App\Controllers;

use App\Helper;
use App\Validator;
use App\Models\User;

class AuthenticationController{

    public function index(){
        return Helper::view('login');
    }
    public function login(){
        $data = [
            "username" => $_POST["username"],
            "password" => $_POST["password"]
        ];
        $validator = new Validator();
        $validator->validate($data);
        if($validator->getValidity()){
            $password = Helper::formatPassword($_POST['password']);
            $user = new User();
            $admin = $user->getUser($data["username"], $password);
            if($admin){
                $_SESSION['user'] = $admin;
                header("Location: " . Helper::route("/admin"));
            }
            else{
                $_SESSION['error'] = "Wrong username or password";
                header("Location: " . Helper::route("/login"));
            }
        }
        else{
            $_SESSION['validationError'] = $validator->getErrors();
            header("Location: " . Helper::route("/login"));
        }

    }
    public function logout(){
        unset($_SESSION['user']);
        header("Location: " . Helper::route("/login"));
    }
}