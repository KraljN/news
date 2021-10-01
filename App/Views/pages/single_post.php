<?php
use App\Helper;
?>
<div class="container d-flex pt-5">
    <div class="col-lg-8">
        <h1 class="text-center text-body fw-normal h1"><?= $data["post"]['title'] ?></h1>
        <p class='mt-4'><?= $data["post"]['text'] ?></p>
        <p class="text-secondary">Date published <span class="text-dark"><?= $data['post']['created_at'] ?></span></p>
        <p class="text-secondary">Category: <span class="text-dark"><?= $data['post']['category_name'] ?></span></p>
        <div class="col-lg-4">
            <form class="d-flex" action="<?= Helper::route("/posts/" . $data["post"]['id'] . "/subscribe") ?>" method="POST">
                <input class="form-control me-2" type="text" name="email" placeholder="Email" aria-label="Email">
                <button class="btn btn-outline-success" type="submit">Subscribe</button>
            </form>
            <?php require __DIR__ . "/../components/validation_info.php" ?>
        </div>
    </div>
    <div class="col-lg-4 px-5">
        <?php require __DIR__ . "/../components/category_aside.php" ?>
    </div>
</div>
</body>