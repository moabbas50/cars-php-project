<?php
include_once 'C:\xampp\htdocs\car_rent\shared\configDatabase.php';
include_once 'C:\xampp\htdocs\car_rent\shared\functions.php';
$img = $_SESSION['client']['image'];
$name= $_SESSION['client']['name'];
?>

<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
    <div class="logo">
            <a href="<?= url("user/client/myProfile.php") ?>"><img src="<?= url("user/assets/img/client/") . $img ?>" alt="" class="img-fluid"></a>
        </div>
        <div class="logo">
            <a href="index.html"><img src="<?= url("user/assets/img/Designer.png") ?>" alt="" class="img-fluid"></a>
        </div>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="<?=url("user/client/homeClient.php")?>"><span>Home</span> </a></li>
                <li><a class="nav-link scrollto" href="<?= url("user/client/creat.php") ?>"><span>Cars</span> </a></li>
                <li><a class="nav-link scrollto " href="<?= url("user/client/oldRent.php") ?>"><span> Old Rents</span></a></li>
                <li><a class="nav-link scrollto active" href="<?= url("user/client/myProfile.php") ?>"><span> My Profile</span></a></li>
                <li>
                    <a class="dropdown-item d-flex align-items-center" onclick="clearSessionDone()" href="<?= url('user/index.php') ?>?logout=">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Sign Out</span>
                    </a>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->