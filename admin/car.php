<?php
include_once 'C:\xampp\htdocs\car_rent\shared\functions.php';
include_once 'C:\xampp\htdocs\car_rent\shared\configDatabase.php';
auth();
include_once './shared/head.php';
include_once './shared/header.php';

if (isset($_GET['id'])) {
    $carid = $_GET['id'];
    $selectclient = "SELECT * FROM `cars` WHERE id = $carid ";
    $alldata1 = mysqli_query($con, $selectclient);
    $rowc = mysqli_fetch_assoc($alldata1);
    $carOWnerId = $rowc['car_owner_id'];
    $Ownerselected = "SELECT * FROM `car-owners` WHERE id = $carOWnerId ";
    $Owner = mysqli_query($con, $Ownerselected);
    $row2 = mysqli_fetch_assoc($Owner);
}


?>
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= url('admin/index.php') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= url('admin/cars.php') ?>">Cars</a></li>
            <li class="breadcrumb-item"><a href="<?= url('admin/clients.php') ?>">Clients</a></li>
            <li class="breadcrumb-item"><a href="<?= url('admin/CarOwners.php') ?>">Cars Owners</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section dashboard">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card info-card ">
                    <h5 class="card-title"><?= $rowc['car_model'] ?></h5>
                    <div class="row">
                        <div class="col-4">
                            <a href="<?= url("user/assets/img/cars/") .  $rowc['images'] ?> " target="_blank">
                                <img style="width: 250px;" src="<?= url("user/assets/img/cars/") .  $rowc['images'] ?> " alt="">
                            </a>
                        </div>

                        <div class="col-lg-6">
                            <div class="d-flex align-items-center">
                                <div class="ps-3">
                                    <h4 class="card-title">Car Number |<span> <?= $rowc['car_number'] ?></span></h4>
                                    <h4 class="card-title">Car Cost | Day | <span><?= $rowc['cost_per_day'] ?> LE.</span></h4>
                                    <h4 class="card-title">Car Owner |<a href="CarOwner.php?id=<?= $row2['id'] ?>"><?= $row2['name'] ?></a></h4>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>




    </div>
</section>




<?php
include_once './shared/script.php';
?>