<?php
use App\Helper;
?>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="<?= Helper::route("/home") ?>">News</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-4">
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= Helper::route("/home") ?>">Home</a>
            </li>
            <?php if(isset($_SESSION['user'])): ?>
                <li class="nav-item">
                <a class="nav-link" aria-current="page" href="<?= Helper::route("/admin") ?>">Admin</a>
                </li>
            <?php endif ?>
            <li class="nav-item">
            <a class="nav-link"
             href="<?php  echo isset($_SESSION['user']) ? Helper::route("/logout") : Helper::route("/login") ?>"
            >
             <?php echo isset($_SESSION['user']) ? "Logout" : "Login"  ?>
            </a>
            </li>
        </ul>
        </div>
    </div>
</nav>