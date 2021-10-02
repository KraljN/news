<?php
namespace App;

use App\Config;

class Helper{
     static function view($pageName, $data = null){
        require __DIR__  .  "/Views/fixed/header.php";
        require __DIR__  .  "/Views/fixed/navigation.php";
        require __DIR__  .  "/Views/pages/" . $pageName . ".php";
        require __DIR__  .  "/Views/fixed/scripts.php";
    }
    static function route($routeName){
        return Config::getConfig("ROOT_PATH") . $routeName;
    }
    static function formatDate($date){
        return date("d.m.Y. H:i", strtotime($date));
    }
    static function formatPassword($password){
        return md5($password);
    }
    static function isEmailSubscribed($email, $subscribers){
        $output = false;
        foreach($subscribers as $subscriber){
            if($subscriber['email'] == $email){
                $output = true;
                break;
            }
        }
        return $output;
    }
    static function routeIs($routeName){
        return @str_starts_with(end(explode("/", $_SERVER["REQUEST_URI"])), $routeName) ? true : false;//PHP 8 funkcija
    }
    static function asset($assetsPath){
        return Config::getConfig("ROOT_PATH") . "/Assets" . $assetsPath;
    }
}