<?php

use App\Helper;
?>
<div class="container d-flex pt-5">
    <div class="col-lg-8">
        <h1 class="text-center mb-3 h2 fw-normal "><?=$data["category"]['category_name'] ?></h1>
        <div class="col-lg-4 mx-auto">
            <form class="d-flex" action="<?= Helper::route("/categories/" . $data["category"]['id']  . "/subscribe") ?>" method="POST">
                <input class="form-control me-2" name="email" type="text" placeholder="Email" aria-label="Email">
                <button class="btn btn-outline-success" type="submit">Subscribe</button>
            </form>
            <?php require __DIR__ . "/../components/validation_info.php" ?>
        </div>
        <?php 
        foreach($data["posts"] as $post){
            include __DIR__  . "/../components/post.php";
        }
        ?>
    </div>
    <div class="col-lg-4 px-5">
        <?php require __DIR__ . "/../components/category_aside.php" ?>
    </div>
</div>
</body>