<?php
use App\Helper;
?>  
    <div class="col-lg-6 mx-auto mt-4">
        <h1 class="h2 text-center fw-normal">
            Log in to Admin panel
        </h1>
        <form class="row g-3" method="POST" action="<?= Helper::route("/login") ?>">
            <div class="col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username">
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Log in</button>
            </div>
        </form>
        <?php require __DIR__ . "/../components/validation_info.php" ?>
    </div>
</body>