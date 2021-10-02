<div class="container d-flex pt-5">
    <div class="col-lg-8">
        <h1 class="text-center mb-3 h2 fw-normal ">Newest news:</h1>
        <div class="col-lg-5 mx-auto">
            <form class="d-flex" action="home" method="GET">
                <input class="form-control me-2" type="search" value="<?php echo isset($_GET['q'])? $_GET['q'] : "" ?>" name="q" placeholder="Search" aria-label="Search"/>
                <button class="btn btn-outline-success" type="submit">Search</button>
                <a class="btn btn-outline-success ms-2" href="home">Show All</a>
            </form>
        </div>
        <?php 
        foreach($data["posts"] as $post){
            include __DIR__  . "/../components/post.php";
        }
        if(empty($data["posts"])):
        ?>
        <div class="alert alert-danger mt-3" role="alert">
            Sorry there is no news with title "<?= $_GET["q"] ?>"
        </div>
        <?php endif ?>
    </div>
    <div class="col-lg-4 px-5">
        <?php require __DIR__ . "/../components/category_aside.php" ?>
    </div>
</div>
</body>