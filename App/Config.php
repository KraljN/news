<?php
namespace App;

class Config{

    static private $data = [
        "USERNAME" => "root",
        "PASSWORD" => "",
        "SERVER" => "localhost",
        "DB_NAME" => 'news',
        'ROOT_PATH' =>  "/news",//=========Root direktorijum u odnosu na htdocs=========
        "EMAIL_ADDRESS" => "binutrima@gmail.com",
        "EMAIL_PASSWORD" => "binutrima@10"
    ];
    static function getConfig($name){
        return self::$data[$name];
    }
}