<?php
include_once 'C:\xampp\htdocs\car_rent\shared\configDatabase.php';
include_once 'C:\xampp\htdocs\car_rent\shared\functions.php';




$img = $_SESSION['owner']['image'];
$name= $_SESSION['owner']['name'];
?>

<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
        <div class="logo">
            <a href="<?= url("user/owner/myProfile.php") ?>"><img src="<?= url("user/assets/img/carOwner/") . $img ?>" alt="" class="img-fluid"></a>
        </div>
        <div class="logo">
            <a href="<?= url("user/owner/homeOwner.php") ?>"><img src="<?= url("user/assets/img/Designer.png") ?>" alt="" class="img-fluid"></a>
        </div>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="<?= url("user/owner/homeOwner.php") ?>"><span>Home</span> </a></li>
                <li><a class="nav-link scrollto" href="<?= url("user/owner/myCars.php") ?>"><span>My Cars</span> </a></li>
                <li><a class="nav-link scrollto " href="<?= url("user/owner/oldRent.php") ?>"><span> Old Rents</span></a></li>
                <li><a class="nav-link scrollto active" href="<?= url("user/owner/myProfile.php") ?>"><span> My Profile</span></a></li>
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