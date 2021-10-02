<?php

namespace App\Controllers;

use App\Helper;

class AdminController extends ContentController{

    public function index(){
        if(!isset($_GET['post_id'])) $_GET['post_id'] = $this->post->getNewestPost()['id'];
        if(!isset($_GET['category_id'])) $_GET['category_id'] = $this->category->getCategories(true)['id'];
        $this->data['postSubscribers'] = $this->post->getSubscribers($_GET['post_id']);
        $this->data['categorySubscribers'] = $this->category->getSubscribers($_GET['category_id']);
        $this->data["posts"] = $this->post->getPosts();
        return Helper::view("admin", $this->data);
    }
}