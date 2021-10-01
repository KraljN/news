<h2 class="text-center fw-normal h2">Categories:</h2>
<ul class="list-group">
<?php

use App\Helper;

foreach($data["categories"] as $category): ?>
    <a href="<?= Helper::route("/categories/" . $category['id']) ?>" class="text-decoration-none hover">
        <li class="list-group-item text-body"><?= $category['category_name'] ?></li>
    </a>
<?php endforeach; ?>
</ul>