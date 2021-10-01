<?php 
namespace App\Controllers;

use App\Models\Category;
use App\Models\Post;

abstract class ContentController{
    protected $post;
    protected $category;
    protected $data;

    public function __construct()
    {
        $this->post = new Post();
        $this->category = new Category();
        $this->data["categories"] = $this->category->getCategories();
    }
}