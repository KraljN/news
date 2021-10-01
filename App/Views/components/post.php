<?php
use App\Helper;
?>
    <div class="container col-8 border text-center py-2 my-2">
        <div class="row d-flex justify-content-around">
            <div class="col-8">
                <a href="<?= Helper::route("/posts/" . $post['id']) ?>" class="text-decoration-none hover">
                    <h2 class="h4 text-secondary fw-light"><?= $post['title'] ?></h2>
                </a>
            </div>
            <?php if(Helper::routeIs('admin')):?>
            <div class="col-1 btn btn-warning"><a href="<?= Helper::route('/admin/posts/edit/' . $post['id']) ?>"><i class="fas fa-edit text-white"></i></a></div>
            <div class="col-1 btn btn-danger delete" data-id="<?= $post['id'] ?>"><i class="fas fa-trash"></i></div>
            <?php endif;?>
        </div>
    </div>