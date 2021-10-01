<?php

namespace App;

class Validator{
    
    private $errors = [];
    private $data = [];
    private $valid = true;
    private $errorMessages = [
        "email" => "Insert email in valid format (nikola.kralj@quantoxtechnology.com)",
        "username" => "Only small letters and numbers allowed, minimum 4 characters",
        "password" => "Mimnum 4 characters, no \");(\" and spaces allowed",
        "title" => "Minimum 3 characters, only words and numbers(every word must start with capital)",
        "text" => "Text field must have at least 5 characters, max 200",
        "all" => "You must change at least one field",
        "category_id" => "You must choose category"
    ];
    private $regExps = [
        "email" => "/^([a-z0-9]{2,15}(\.[a-z0-9]{2,15}){0,5}@[a-z]{2,20}\.[a-z]{2,5})(\.[a-z]{2,5})*$/",
        "username" => "/^[\d\w]{4,15}$/",
        "password" => "/^[^;()\s]{4,15}$/",
        "title" => "/^[A-Z\d][a-z\d]{0,15}(\s[A-Z\d][a-z\d]{0,15})*$/",
        "text"=>"/[\w\d\.()\[\]\s\$#]{5,200}/",
        "category_id" => "/[1-9]{1,255}/"
    ];

    public function validate($data){
        
        foreach($data as $field => $value){
            if($field == "category"){
                if($value == "0"){
                    $this->valid = false;
                    $this->errors[$field] = $this->errorMessages[$field];
                }
            }
            else{
                if(!preg_match($this->regExps[$field], $value)){
                    $this->valid = false;
                    $this->errors[$field] = $this->errorMessages[$field];
                }
            }
        }
        return;
    }
    public function checkDifference($dataNow, $dataBefore){
        if(count( array_diff_assoc($dataNow, $dataBefore)) == 0 ){
            $this->valid = false;
            $this->errors["all"] = $this->errorMessages["all"];
        }
        return;
    }

    public function getValidity(){
        return $this->valid;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}