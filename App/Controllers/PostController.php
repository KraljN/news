<?php
namespace App\Controllers;

use App\Helper;
use App\Mail\CategoryMail;
use App\Mail\PostMail;
use App\Validator;
use Exception;

session_start();

class PostController extends ContentController{
    
    public function index(){
        $where = isset($_GET["q"]) && !empty($_GET["q"]) ? $_GET["q"] : "";
        $this->data['posts'] = $this->post->getPosts($where);
        return Helper::view("home", $this->data);
    }
    public function show($id){
        $this->data['post'] = $this->post->getSinglePost($id);
        $this->data['post']['created_at'] = Helper::formatDate($this->data['post']['created_at']);
        return Helper::view("single_post", $this->data);
    }
    public function create(){
        return Helper::view('post_form', $this->data);
    }
    public function edit($id){
        $this->data['post'] = $this->post->getSinglePost($id);
        $_SESSION['post'] = $this->data['post'];
        return Helper::view('post_form', $this->data);
    }
    public function update($id){
        $validator = new Validator();
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') //Kod preuzet sa interneta za PUT zahtev
            {
                parse_str(file_get_contents("php://input"), $_PUT);

                foreach ($_PUT as $key => $value)
                {
                    unset($_PUT[$key]);

                    $_PUT[str_replace('amp;', '', $key)] = $value;
                }
                $_REQUEST = array_merge($_REQUEST, $_PUT);
            }
            $data = $_REQUEST;
            unset($data['id']);
            $dataBefore = $this->post->getSinglePost($id);
            $validator->checkDifference($data, $dataBefore);
            $validator->validate($data);
            if($validator->getValidity()){
                try{
                    $categoryIdBeforeUpdate = $this->post->getSinglePost($_REQUEST['id'])['category_id'];
                    $this->post->updatePost($data, $_REQUEST['id']);
                    $postAfterUpdate = $this->post->getSinglePost($_REQUEST['id']);
                    $_SESSION['success'] = "You successfully updated this post!";


                    //Mail za novi post
                    $postMail = new PostMail();
                    $postMail->sendMail($this->post, $_REQUEST['id']);

                    //Mail za novu kategoriju ukoliko je ubacena
                    if($categoryIdBeforeUpdate != $_REQUEST['category_id']){
                        $categoryMail = new CategoryMail();
                        $categoryMail->sendMail($postAfterUpdate, $postAfterUpdate['category_id']);
                    }
                    if($this->post->getSinglePost($_REQUEST['id']))
                    header("Content-Type: application/json");
                    http_response_code(204);
                }
                catch(Exception $e){
                    $_SESSION['error'] = "There has been updating this post, please try again later";
                }
            }
            else{
                $_SESSION['validationError'] = $validator->getErrors();
                header("Content-Type: application/json");
                http_response_code(422);
                echo json_encode(["message" => "error"]);
            }
        }
    public function store(){
        $validator = new Validator();
        $validator->validate($_POST);
        if($validator->getValidity()){
            try{
                $this->post->insertPost($_POST['title'], $_POST['text'], $_POST['category_id']);
                $_SESSION['success'] = "You successfully inserted post!";

                $categoryMail = new CategoryMail();
                $mailParameters = [
                    "title" => $_POST['title'],
                    "category_name" => $this->category->getSingleCategory($_POST['category_id'])['category_name']
                ];
                $categoryMail->sendMail($mailParameters, $_POST['category_id']);
                
                header("Location: " . Helper::route("/admin/posts/create"));
            }
            catch(Exception $e){
                $_SESSION['error'] = "There has been problem inserting this post, please try again later";
                header("Location: " . Helper::route("/admin/posts/create"));
            }
        }
        else{
            $_SESSION['validationError'] = $validator->getErrors();
            header("Location: " . Helper::route("/admin/posts/create"));
        }
    }
    public function destory($id){
        
    }
}