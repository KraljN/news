<?php

use App\Helper;
?>
<div class="container mt-3">
    <h1 class="text-center mb-3 h2 fw-normal ">Admin Panel</h1>
    <div class="row mb-4">
        <div class="col-8 text-center"><h2 class="h3 fw-light">Posts</h2></div>
        <div class="col-4">
            <a href="<?= Helper::route('/admin/posts/create') ?>">
                <button class="btn btn-primary">Add Post</button>
            </a>
        </div>
    </div>
    <?php
    foreach($data["posts"] as $post){
            include __DIR__  . "/../components/post.php";
    }
    ?>
    <div class="row">
    <h2 class="h3 fw-light text-center my-3">Subsribers</h2>
        <div class="container col-lg-6">
        <div class="row  d-flex justify-content-around">
            <div class="col-lg-4">
                <form action="<?= Helper::route("/admin") ?>" method="GET">
                <select class="form-select" name="post_id">
                    <?php foreach($data['posts'] as $i => $post): ?>
                    <option  value="<?= $post['id'] ?>"
                    <?php if($_GET['post_id'] == $post['id']):?>
                        selected="selected"
                    <?php endif ?>
                    ><?= $post['title'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
            <div class="table-responsive">
            <?php if(@ count($data['postSubscribers']) > 0): ?>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($data['postSubscribers'] as $i=> $postSubscriber): ?>
                        <tr>
                            <td><?= ++$i ?></td>
                            <td><?= $postSubscriber['email'] ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="alert alert-info mt-4" role="alert">
                    There is no emails subscribed to this post
                </div>  
                <?php endif ?>
            </div>
        </div>
        <div class="container col-lg-6 ">
        <div class="row d-flex justify-content-around">
            <div class="col-lg-4">
                <select class="form-select" name="category_id">
                    <?php foreach($data['categories'] as $i => $category):?>
                    <option 
                    value="<?= $category['id'] ?>"
                    <?php if($_GET['category_id'] == $category['id']):?>
                        selected="selected"
                    <?php endif ?>
                    ><?= $category['category_name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-lg-2">
                <input type="submit" class="btn btn-primary" value="Filter Subscribers"/>
                </form>
            </div>
        </div>
            <div class="table-responsive">
                <?php if(@count($data['categorySubscribers']) > 0): ?>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($data['categorySubscribers'] as $i=> $categorySubscriber): ?>
                        <tr>
                            <td><?= ++$i ?></td>
                            <td><?= $categorySubscriber['email'] ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="alert alert-info mt-4" role="alert">
                    There is no emails subscribed to this category
                </div>  
                <?php endif ?>
            </div>
        </div>
    </div>
</div>