<?php
namespace App\Controllers;

use App\Helper;

class CategoryController extends ContentController{
    public function show($id){
        $this->data["category"] = $this->category->getSingleCategory($id);
        $this->data["posts"] = $this->category->getPosts($id);
        return Helper::view("category", $this->data);
    }
}