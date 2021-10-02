<?php

use App\Helper;

session_start();

$router->setNamespace('\App\Controllers');
$router->get("/home", "PostController@index");
$router->get("/", "PostController@index");
$router->get("/posts/{id}", "PostController@show");
$router->post("/posts/{id}/subscribe", "PostSubscribeController@subscribe");
$router->get("/categories/{id}", "CategoryController@show");
$router->post("/categories/{id}/subscribe", "CategorySubscribeController@subscribe");
$router->get("/login", "AuthenticationController@index");
$router->get("/logout", "AuthenticationController@logout");
$router->post("/login", "AuthenticationController@login");
$router->get("/admin", "AdminController@index");
$router->get("/admin/posts/create", "PostController@create");
$router->get("/admin/posts/edit/{id}", "PostController@edit");
$router->delete("/admin/posts/destroy/{id}", "PostController@destroy");
$router->put("/admin/posts/update/{id}", "PostController@update");
$router->post("/admin/posts/store", "PostController@store");
$router->before('GET|POST|PUT|DELETE', '/admin/.*', function() {
    if (!isset($_SESSION['user'])) {
        header('location: ' . Helper::route("/login"));
        exit();
    }
});
$router->before('GET', '/admin*', function() {
    if (!isset($_SESSION['user'])) {
        header('location: ' . Helper::route("/login"));
        exit();
    }
});
