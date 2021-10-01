<?php 
if(isset($_SESSION['success'])):?>
    <div class="alert alert-success mt-3" role="alert">
        <?= $_SESSION['success'] ?>
    </div>
<?php
    unset($_SESSION['success']);
    elseif(isset($_SESSION['error'])):?>
    <div class="alert alert-danger mt-3" role="alert">
        <?= $_SESSION['error'] ?>
    </div>
<?php
    unset($_SESSION['error']);
    elseif(isset($_SESSION['validationError'])):?>
    <div class="alert alert-danger mt-3 px-2" role="alert">
        <ul class="list-unstyled">
            <?php foreach($_SESSION['validationError'] as $name => $error): ?>
                <li><strong><?=$name ?>:</strong> <?= $error ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php
    unset($_SESSION['validationError']);
    endif;
?>