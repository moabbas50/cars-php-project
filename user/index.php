<?php
include_once './shared/head.php';
?>

<div id="layout" class="main">
    <div class="container-fluid">
        <div class="row text-center ">
            <div class="col-lg-6">
                <a href="<?= url("user/client/login.php")?>" class="btn btn-inf  "><span>login as Client</span> </a>
            </div>
            <div class="col-lg-6">
                <a href="<?= url("user/owner/login.php")?>" class="btn btn-inf "><span>login as Car Owner</span> </a>
            </div>
        </div>
    </div>
</div>


<?php
include_once './shared/script.php';
?>