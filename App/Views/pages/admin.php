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
</div>