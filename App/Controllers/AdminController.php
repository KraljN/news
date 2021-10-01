<?php

namespace App\Controllers;

use App\Helper;

session_start();

class AdminController extends ContentController{

    public function index(){
        $this->data["posts"] = $this->post->getPosts();
        return Helper::view("admin", $this->data);
    }
}